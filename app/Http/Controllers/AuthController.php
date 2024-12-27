<?php

namespace App\Http\Controllers;

use App\Mail\NewPassword;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function employee_register_page(Request $request)
    {
        $data = [
            'page_name' => 'employee_register',
            'page_title' => 'Register | Employee | Egy Finance',
        ];
        return view('website.auth.employee_register', $data);
    }
    public function employee_register(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'g-recaptcha-response' => 'recaptcha',
        ]);

        $encryption = [
            'email' => $request->email,
        ];
        $encryption = Crypt::encrypt($encryption);

        $user = User::create([
            'first_name' => ucfirst(trans($request->first_name)),
            'last_name' => ucfirst(trans($request->last_name)),
            'email' => $request->email,
            'remember_token' => $encryption,
            'password' => bcrypt($request->password),
        ]);

        $user->attachRole('employee');
        Mail::to($user->email)->send(new VerifyEmail($user));
        session()->flash('alert_message', ['message' => 'The account has been created successfully, please Check  your E-Mail To Verify Your account!', 'icon' => 'success']);
        return redirect()->route('login');
    }

    public function employer_register_page(Request $request)
    {
        $data = [
            'page_name' => 'employer_register',
            'page_title' => 'Register | Employer | Egy Finance',
        ];
        return view('website.auth.employer_register', $data);
    }
    public function employer_register(Request $request) {}

    public function forget_password()
    {
        $data = [
            'page_name' => 'forget password',
            'page_title' => 'Egy Finance | Forget Password',
        ];
        return view('website.auth.forget_password', $data);
    }

    public function new_password(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required'],
        ]);
        $user = User::where(['email' => $request->email])->first();
        if ($user) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            $length = 8;
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $new_password = $randomString;
            $password = bcrypt($new_password);
            $user->update(['password' => $password]);
            Mail::to($user->email)->send(new NewPassword($new_password, $user));
            session()->flash('alert_message', ['message' => 'New Password Send To Your E-Mail', 'icon' => 'success']);
            return redirect()->route('login');
        } else {
            return back()->withErrors(['password_error' => 'This E-Mail Not Found!.']);
        }
    }


    public function login_page()
    {
        $data = [
            'page_name' => 'login',
            'page_title' => 'Egy Finance | Login',
        ];
        return view('website.auth.login', $data);
    }
    public function active_account(Request $request)
    {
        $user = User::where('remember_token', $request->token)->first();
        if ($user) {
            $user->update(['email_verified_at' => now()]);

            session()->flash('alert_message', ['message' => 'The account has been Verified successfully', 'icon' => 'success']);
            return redirect()->route('login');
        } else {
            return back()->withErrors(['login_error' => 'The provided credentials do not match our records.']);
        }
    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        $user = User::where(['email' => $request->email])->first();
        if ($user && $user->email_verified_at == null) {
            Mail::to($user->email)->send(new VerifyEmail($user));
            return back()->withErrors(['login_error' => 'please Check  your E-Mail To Verify Your account!.']);
        }
        $remember = $request->has('remember') ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            // employee.profile.create

            if ($user->employee_profile) {
                return back();
            } else {

                return redirect()->route('employee.profile.create');
            }
        } else {
            return back()->withErrors(['login_error' => 'The provided credentials do not match our records.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
