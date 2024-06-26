<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\Enums\Roles;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');

        $request->validate([
            'username' => 'bail|required|alpha_num',
            'password' => 'bail|required',
            'remember' => 'bail|nullable',
        ]);

        $rememberMe = $request->boolean('remember');

        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === Roles::ADMIN) {
                return redirect()->intended(route('dashboard'));
            } elseif ($user->role === Roles::UPLOADER) {
                return redirect()->intended(route('receipts.create'));
            } else
                return redirect()->intended(route('receipts.validate.unvalidated'));
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        Session::invalidate();

        return redirect()->route('auth.login');
    }
}
