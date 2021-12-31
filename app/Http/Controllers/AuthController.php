<?php

namespace App\Http\Controllers;

use App\Models\LoginToken;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse | View
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::whereEmail($data['email'])->first();

        if (!$user) {
            return view('auth.login', [
                'register' => true,
                'email' => $data['email'],
            ]);
        }

        $user->sendLoginLink();
        session()->flash('success', true);
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    public function verifyLogin(Request $request, string $token): RedirectResponse
    {
        $token = LoginToken::whereToken(hash('sha256', $token))->firstOrFail();
        abort_unless($request->hasValidSignature() && $token->isValid(), 401);
        $token->consume();
        Auth::login($token->user);
        return redirect('/');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'name' => ['required'],
        ]);

        User::create(['name' => $data['name'], 'email' => $data['email']])->sendLoginLink();
        session()->flash('success', true);
        return redirect()->back();
    }
}
