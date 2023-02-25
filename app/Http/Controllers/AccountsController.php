<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class AccountsController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            if (auth()->user()->user_type === 'admin') {
                return redirect('/admin');
            }
        }
        return view('admin.login');
    }
    public function logout()
    {
        if (!auth()->check() && auth()->user()->user_type !== 'admin') {
            return redirect('/admin/accounts/login');
        }
        return view('admin.logout');
    }
    public function logout_function(Request $request)
    {
        $request->session()->flush();
        return redirect('/admin/accounts/login');
    }

    public function forgot_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function reset_password($token)
    {
        return view('client.reset', ['token' => $token]);
    }
    public function reset_password_update(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);


        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
