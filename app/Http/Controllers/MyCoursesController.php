<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Requests\TermRequest;
use App\Models\Course;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;

class MyCoursesController
{
    public function get() {
        $foundCourses = Auth::user()->role == 'admin' ? Course::all() : Course::all()->where('guarantorID', Auth::id());
        return view('myCourses', ['courses' => $foundCourses]);
    }

    public function getCourse($id) {
        $courses = Course::find($id);
        $terms = Term::all()->where('courseID', $id);
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
            'capacity' => (int)$request->input('capacity')
        ]);

        return redirect('my-courses');
    }

    function getTerm($courseId, $termId) {
        return view('termEdit', ['courseId' => $courseId, 'term' => Term::find($termId)]);
    }

    public function newTerm($courseId) {
        return view('termEdit', ['courseId' => $courseId, 'term' => new Term()]);
    }

    function deleteCourseTerm($courseId, $termId) {
        $toDelete = Term::find($termId);
        if (!$toDelete) redirect('myCourses');

        $toDelete->delete();
        return redirect('courseEdit', $courseId);
    }

    function getCourseRegistrations($id) {
        return view('registrationManagement', ['course' => Course::all()->where('id', $id)->first()]);
    }

    public function createTerm($courseId, TermRequest $request) {
        Term::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'description' => $request->input('description'),
            'score' => (int)$request->input('score'),
            'date_from' => now(),
            'date_to' => now(),
            'capacity' => (int)$request->input('capacity'),
            'courseID' => $courseId,
            'teacherID' => Auth::id()
        ]);

        return redirect('my-courses');
    }
}
