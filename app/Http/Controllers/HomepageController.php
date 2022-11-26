<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomepageController
{
    public function getCourses(Request $request) {
        $courses = Course::all();
        $fulltextString = $request->query('fulltext');

        $courses = $courses->filter(function ($course) use ($fulltextString) {
            return str_contains($course->shortcut, $fulltextString) || str_contains($course->name, $fulltextString);
        });

        return view('homepage', ['courses' => $courses]);
    }

    public function regCourse(Request $request, $courseID) {

        $course = Person::where('id', Auth::user()->id)->first()->registeredCourses()->where('courseID', $courseID)->first();
        if(!$course){
            StudentCourse::create([
                'studentID'=>Auth::user()->id,
                'courseID'=>$courseID,
            ]);
        }
        return redirect('/');
    }
}