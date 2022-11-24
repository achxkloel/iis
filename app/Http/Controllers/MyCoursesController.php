<?php

namespace App\Http\Controllers;

use App\Models\Course;

class MyCoursesController
{
    public function get() {
        // TODO: filter courses to match the teacherId
        return view('myCourses', ['courses' => Course::all()]);
    }

    public function getCourse($id) {
        return view('courseEdit', ['course' => Course::all()->where('id', $id)->first()]);
    }

    function getCourseRegistrations($id) {
        return view('registrationManagement', ['course' => Course::all()->where('id', $id)->first()]);
    }
}
