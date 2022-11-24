<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePersonRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Validation rules for login
    private $login_rules = 'required|min';

    public function showPersons () {
        return view('admin.persons', ['persons' => Person::all()]);
    }

    public function showClasses () {
        return view('admin.classes');   
    }

    public function showPersonForm () {
        return view('admin.personCreate');
    }

    public function createNewPerson (CreatePersonRequest $request) {
        $data = $request->validated();

        if (Person::where('login', $data['login'])->exists()) {
            return back()
                ->withErrors([
                    'error' => true,
                ])
                ->withInput();
        }

        $password = Str::random(20);

        $person = Person::create([
            'login' => $data['login'],
            'password' => Hash::make($password),
            'name' => $data['name'],
            'surname' => $data['surname'],
            'role' => $data['role']
        ]);

        $person->assignRole($this->getRolesList($data['role']));

        return back()->with([
            'success' => true,
            'login' => $data['login'],
            'password' => $password
        ]);
    }

    public function checkLogin (Request $request) {
        return response()->json([ 'msg' => 'test' ]);
    }

    private function getRolesList (string $role) {
        $additional_roles = [];

        switch ($role) {
            case 'guarantor':
                $additional_roles = ['teacher', 'student'];
                break;
            case 'teacher':
                $additional_roles = ['student'];
                break;
        }

        return array_push($additional_roles, $role);
    }
}