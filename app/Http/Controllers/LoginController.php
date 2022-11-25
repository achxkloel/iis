<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{

    public function index () {
        return view('login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function auth(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'alert' => 'Nesprávný login nebo heslo',
        ]);
    }
}
