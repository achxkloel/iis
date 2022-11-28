<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\StudentScore;
use App\Models\Term;
use App\Models\StudentTerm;


class StudiesOverviewController
{

    //TODO ask Evzen about how this works
    public function getRegCourses() {
        
        // $course = Course::join('student_course', 'course.id', '=', 'courseID')
        // ->join('person', 'person.id', '=', 'studentID')
        // ->where('person.id', Auth::user()->id)->where('student_course.is_active', '=', '1')->get('course.*');
        
        $person = Person::where('id', Auth::user()->id)->first();

        if (!$person) {
            return abort(404);
        }

        // Get total score for every student and course
        $student_scores = StudentScore::select([
                'studentID',
                'courseID',
                StudentScore::raw('SUM(student_score.score) as total_score')
            ])
            ->join('term', 'term.id', '=', 'termID')
            ->groupBy([
                'studentID',
                'courseID'
            ]);

        // Get person courses as a student
        $student_courses = Course::join('student_course', 'course.id', '=', 'courseID')
            ->leftJoinSub($student_scores, 'student_scores', function ($join) {
                $join->on('student_course.studentID', '=', 'student_scores.studentID');
                $join->on('course.id', '=', 'student_scores.courseID');
            })
            ->where('student_course.studentID', $person->id)
            ->get([
                'course.*',
                'student_course.updated_at as registered_at',
                'total_score',
                'student_course.id as studentCourseID'
            ]);


        return view('studiesOverview', ['courses' => $student_courses]);
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
                'termID'=>$termId,
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
            StudentScore::
                where('studentID', Auth::user()->id)
                ->where('termID', $termId)->delete();
        }
        return redirect()->route('course-overview', $courseId);
    }
}
