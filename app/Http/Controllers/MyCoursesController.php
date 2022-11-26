<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MyCoursesController
{
    public function get() {
        $foundCourses = Auth::user()->role == 'admin' ? Course::all() : Course::all()->where('guarantorID', Auth::id());
        return view('myCourses', ['courses' => $foundCourses]);
    }

    public function getCourse($id) {
        $courses = Course::find($id);
        $terms = Term::all();
        return view('courseEdit', ['course' => $courses, 'terms' => $terms]);
    }

    public function newCourse() {
        return view('courseEdit', ['course' => new Course()]);
    }

    public function createCourse(CourseRequest $request) {
        Course::create([
            'shortcut' => $request->input('shortcut'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'type' => 'TODO',
            'capacity' => (int)$request->input('capacity'),
            'guarantorID' => Auth::id()
        ]);

        return redirect('my-courses');
    }

    function updateCourse(CourseRequest $request, $id) {
        Course::find($id)->update([
            'shortcut' => $request->input('shortcut'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'type' => 'TODO',
            'capacity' => (int)$request->input('capacity')
        ]);

        return redirect('my-courses');
    }

    function getCourseRegistrations($id) {
        return view('registrationManagement', ['course' => Course::all()->where('id', $id)->first()]);
    }
}
