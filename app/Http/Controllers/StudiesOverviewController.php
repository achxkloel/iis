<?php

namespace App\Http\Controllers;

use App\Models\Course;

class StudiesOverviewController
{
    public function get() {
        return view('studiesOverview', ['courses' => Course::all()]);
    }

    public function getCourse($id) {
        return view('courseOverview', ['course' => Course::all()->where('id', $id)->first()]);
    }
}
