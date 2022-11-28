<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Person;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function show() {
        return view('profile');
    }

    public function update (UpdateProfileRequest $request) {
        $data = $request->validated();

        if ($data['birth_date'] != NULL) {
            $birth_date = Carbon::createFromFormat('d.m.Y', $data['birth_date']);
            $birth_date->setTimeFromTimeString('00:00:00');
            $data['birth_date'] = $birth_date;
        }

        Person::where('id', Auth::user()->id)->update($data);
        return back();
    }
}