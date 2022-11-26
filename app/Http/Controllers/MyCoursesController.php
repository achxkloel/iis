<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Requests\TermRequest;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Term;
use DateTime;
use Exception;
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
        return view('termEdit', ['courseId' => $courseId, 'term' => Term::find($termId), 'rooms' => Classroom::all()]);
    }

    public function newTerm($courseId) {
        return view('termEdit', ['courseId' => $courseId, 'term' => new Term(), 'rooms' => Classroom::all()]);
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

    /**
     * @throws Exception
     */
    public function createTerm($courseId, TermRequest $request) {
        // TODO: dates
        Term::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'description' => $request->input('description'),
            'score' => (int)$request->input('score'),
            'date_from' => new DateTime($request->input('date-from')),
            'date_to' => $request->input('date-to'),
            'capacity' => (int)$request->input('capacity'),
            'courseID' => $courseId,
            'classID' => $request->input('room') != 0 ? $request->input('room') : null,
            'teacherID' => Auth::id()
        ]);

        return redirect('course-edit/'.$courseId);
    }

    function updateTerm(TermRequest $request, $courseId, $termId) {
        Term::find($termId)->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'description' => $request->input('description'),
            'score' => (int)$request->input('score'),
            'date_from' => $request->input('date-from'),
            'date_to' => $request->input('date-to'),
            'capacity' => (int)$request->input('capacity'),
            'courseID' => $courseId,
            'classID' => (int)$request->input('room') != 0 ? $request->input('room') : null,
            'teacherID' => Auth::id()
        ]);

        return redirect('course-edit/'.$courseId);
    }
}
