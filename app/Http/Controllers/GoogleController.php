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
        $user = Socialite::driver('google')->user();
        $finduser = User::where('google_id', $user->id)
            ->orWhere('email', $user->email)
            ->first();
        if ($finduser) {
            if ($finduser->google_id) {
                Auth::login($finduser);
                session()->flash(
                    'alert_message',
                    ['message' => 'Welcome Back, ' .  $finduser->first_name . '!', 'icon' => 'success']
                );
            } else {
                $finduser->update([
                    'google_id' => $user->id,
                ]);
                Auth::login($finduser);
                session()->flash(
                    'alert_message',
                    ['message' => 'Welcome Back, ' .  $finduser->first_name . '!' .
                        'Your Profile has been attached to your google account!', 'icon' => 'warning']
                );
            }
            if (session('prev_link')) {
                return redirect(session('prev_link'));
            } else {
                return redirect()->route('website.home');
            }
        } else {
            $newUser = User::create([
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
    }
}
