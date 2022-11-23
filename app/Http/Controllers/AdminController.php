<?php

namespace App\Http\Controllers;

use App\Models\Person;

class AdminController extends Controller
{
    public function showPersons () {
        return view('admin.persons', ['persons' => Person::all()]);
    }

    public function showClasses () {
        return view('admin.classes');   
    }

    public function showPersonForm () {
        return view('admin.personCreate');
    }

    public function createNewPerson () {
        return back();
    }

    public function checkLogin () {
        return back();
    }
}