<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserKitaAuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('UsersKita.auth.login', [
            'loginRoute' => 'userkita.login.store',
            'registerRoute' => 'userkita.register',
            'loginField' => 'login',
            'loginLabel' => 'Username atau Email',
            'loginPlaceholder' => 'Masukkan username atau email',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $login = $credentials['login'];
        $throttleKey = Str::transliterate(Str::lower($login).'|'.$request->ip());
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                'login' => 'Terlalu banyak percobaan login. Silakan coba lagi nanti.',
            ]);
        }

        $loginColumn = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (! Auth::attempt([
            $loginColumn => $login,
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {
            RateLimiter::hit($throttleKey);

            throw ValidationException::withMessages([
                'login' => 'Username/email atau password salah.',
            ]);
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        return redirect()->route('home');
    }
}
