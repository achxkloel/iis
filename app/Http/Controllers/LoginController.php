<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ActivateRequest;
use App\Models\Person;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    public function index () {
        return view('login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'alert' => 'Nesprávný login nebo heslo',
            ]);
        }

        if (!Auth::user()->is_active) {
            Auth::logout();

            return back()->withErrors([
                'alert' => 'Účet není aktivovaný'
            ]);
        }

        $request->session()->regenerate();
        return redirect()->intended();
    }

    public function activatePerson (ActivateRequest $request) {
        $validated = $request->validated();

        Log::debug($validated);
        $person = Person::where('login', $validated->login)->first();

        if (!$person) {
            return back()->withErrors([
                'login_not_found' => true
            ])->onlyInput('login');
        }

        if (!Hash::check($validated->tempPassword, $person->password)) {
            return back()->withErrors([
                'alert' => 'Špatné dočasné heslo'
            ]);
        }

        $person->is_active = true;
        $person->password = Hash::make($validated->newPassword);
        $person->save();

        return redirect('login')->with([
            'activated' => 'Účet byl úspěšně aktivovan'
        ]);
    }

    public function showActivatePage () {
        return view('activate');
    }
}