<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\CreateClassRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function showPersons () {
        return view('admin.persons', ['persons' => Person::all()]);
    }

    public function showClasses () {
        return view('admin.classes', ['classes' => Classroom::all()]);
    }

    public function showPersonForm () {
        return view('admin.personCreate');
    }

    public function showClassForm () {
        return view('admin.classCreate');
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

    public function createNewClass (CreateClassRequest $request) {
        $data = $request->validated();

        Classroom::create($data);

        return redirect()->route('admin-classes')->with([
            'success' => true,
            'name' => $data['name']
        ]);
    }

    public function deletePerson (Request $request) {
        Person::where('id', $request->input('id'))->delete();
        return back();
    }

    public function deleteClass (Request $request) {
        Classroom::where('id', $request->input('id'))->delete();
        return back();
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