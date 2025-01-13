<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class GoogleController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect(session('prev_link'));
            } else {
                // session()->flash(
                //     'alert_message',
                //     ['message' => 'This Google Email is not registered, Please Register First! ', 'icon' => 'danger']
                // );
                // return redirect()->intended('/login');
                // if ($request->url == ('admin/*')) {
                //     // code
                // }
                $newUser = User::create([
                    // 'first_name' => ucfirst($user->user['given_name']), // first name
                    // 'last_name' =>  ucfirst($user->user['family_name']), // second and family name
                    'first_name' => ucfirst(explode(' ', $user->name)[0]), // first name
                    'last_name' =>  ucfirst(explode(' ', $user->name)[1]), // second name only
                    'email' => $user->email,
                    'password' => 'password',
                    'google_id' => $user->id,
                    'email_verified_at' => Carbon::now()
                ]);
                $newUser->attachRole('employee');
                Auth::login($newUser);
                session()->flash(
                    'alert_message',
                    ['message' => 'The account has been created successfully, please complete your profile!', 'icon' => 'success']
                );
                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
