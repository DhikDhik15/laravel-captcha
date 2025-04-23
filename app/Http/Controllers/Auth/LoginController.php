<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $credentials['password'] = md5($credentials['password']); // Decrypt MD5

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('LoginToken')->accessToken;

            return redirect()->intended('/home')->with('token', $token);
        }

        return back()->withErrors(['email' => 'Login gagal.'])->withInput();
    }
}
