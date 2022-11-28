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
        $courses = Course::where('is_confirmed', true)->get();
        $fulltextString = $request->query('fulltext');
        $courses = $courses->filter(function ($course) use ($fulltextString) {
            return str_contains($course->shortcut, $fulltextString) || str_contains($course->name, $fulltextString);
        });

        if(Auth::check()) {

            $studentcourses = StudentCourse::where('studentID', Auth::user()->id)->get();
            return view('homepage', ['courses' => $courses, 'studentcourses'=>$studentcourses]);
            
        }
        else
        {
            return view('homepage', ['courses' => $courses]);
        }
    }

    public function regCourse(Request $request, $courseID) {
        $course = Course::where('id', $courseID)->first();

        if (!$course->is_confirmed) {
            return redirect()->route('homepage');
        }

        $course = Person::where('id', Auth::user()->id)->first()->registeredCourses()->where('courseID', $courseID)->first();
        if(!$course){
            StudentCourse::create([
                'studentID'=>Auth::user()->id,
                'courseID'=>$courseID,
            ]);
        }
        else{
            return redirect()->route('homepage')->with(['register_error'=>'Kurz už je zaregistrovaný']);
        }
        return redirect()->route('homepage');
    }

    public function getCourseDetail($courseID) {
        return view('courseDetail', ['course' => Course::all()->where('id', $courseID)->first()]);
    }
}
