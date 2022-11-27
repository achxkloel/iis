<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\StudentCourse;
use App\Models\Term;
use App\Models\StudentTerm;


class StudiesOverviewController
{
    public function getRegCourses() {
        
        $course = Course::join('student_course', 'course.id', '=', 'courseID')
        ->join('person', 'person.id', '=', 'studentID')
        ->where('person.id', Auth::user()->id)->where('student_course.is_active', '=', '1')->get('course.*');

        return view('studiesOverview', ['courses' => $course]);
    }

    public function getCourse(Request $request, $courseId) {
        

        $course = Course::where('id', $courseId)->first();
        $terms = $course->terms()->get();
        $userterms = Term::join('student_term', 'term.id','=','termID')
        ->where('studentID', Auth::user()->id)->get('term.*');

        return view('courseOverview', [
            'course' => $course,
            'terms' => $terms,
            'userterms' => $userterms
        ]);
    }

    public function regTerm(Request $request, $courseId, $termId) {

        $term = StudentTerm::where('studentID', Auth::user()->id)->where('termID', $termId)->first();
        if(!$term){
            StudentTerm::create([
                'studentID'=>Auth::user()->id,
                'termID'=>$termId
            ]);
        }

        return redirect()->route('course-overview', $courseId);
    }

    public function unregTerm(Request $request, $courseId, $termId) {

        $term = StudentTerm::where('studentID', Auth::user()->id)->where('termID', $termId)->first();
        if($term){
            StudentTerm::
                where('studentID', Auth::user()->id)
                ->where('termID', $termId)->delete();
        }

        return redirect()->route('course-overview', $courseId);
    }
}
