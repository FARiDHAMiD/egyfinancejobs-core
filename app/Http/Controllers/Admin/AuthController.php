<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('website.home');
            }
        }
        $data = [];
        return view('admin.auth.login', $data);
    }

    public function login_auth(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed
            return redirect()->route('admin.home');
        }
        // Authentication failed
        return redirect()->back()->withInput()->withErrors(['login_error' => 'Invalid credentials. Please try again.']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
