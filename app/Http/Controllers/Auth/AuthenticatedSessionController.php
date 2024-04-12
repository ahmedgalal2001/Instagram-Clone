<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->email_verified_at) {
                $request->authenticate();

                $request->session()->regenerate();
                if($user->is_admin == 1){
                    return redirect()->intended(RouteServiceProvider::ADMIN);
                }
                else{
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }
            return redirect()->route('verify.sendMsg', ['email' => $user->email]);

        } else {
            return back()->withErrors(['email' => 'The User Not Found.']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
