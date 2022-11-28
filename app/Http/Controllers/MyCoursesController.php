<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Requests\TeacherCourseRequest;
use App\Http\Requests\TermRequest;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Person;
use App\Models\TeacherCourse;
use App\Models\StudentTerm;
use App\Models\Term;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCoursesController
{
    public function getTeachingCourses() {
        // $teachingCourses = Auth::user()->role == 'admin' ? Course::all() : Course::all()->where('guarantorID', Auth::id());
        // TeacherCourse::all()->where('teacherID', Auth::id());
        // $unconfirmedCourses = Auth::user()->role == 'admin' ? Course::all()->where('is_confirmed', false) : Course::all()->where('guarantorID', Auth::id())->where('is_confirmed', false);
        
        
        $teachingCourses = Course::all()->where('is_confirmed', true);
        $unconfirmedCourses = Course::all()->where('is_confirmed', false);

        if(Auth::user()->role != 'admin') {
            $teachingCourses = Course::join('teacher_course', 'course.id', '=', 'courseID')->where('teacherID', Auth::id())->get();
            $unconfirmedCourses = Course::all()->where('guarantorID', Auth::id())->where('is_confirmed', false);
        }
        return view('myCourses', ['unconfirmedcourses' => $unconfirmedCourses,'teachingcourses' => $teachingCourses]);
    }

    // public function getUnconfirmedCourses() {
    //     $foundCourses = Auth::user()->role == 'admin' ? Course::all()->where('is_confirmed', false) : Course::all()->where('guarantorID', Auth::id())->where('is_confirmed', false);
    //     return view('myCourses', ['unconfirmedcourses' => $foundCourses]);
    // }

    public function getCourse($id) {
        $course = Course::find($id);
        $terms = Term::all()->where('courseID', $id);
        $teacherCourse = TeacherCourse::all()->where('courseID', $id);

        $teachers = Person::all()->where('role', 'teacher');
        $guarantors = Person::all()->where('role', 'guarantor');
        $teachers = $teachers->merge($guarantors);

        $teachers = $teachers->filter(function ($item) use ($teacherCourse) {
            $found = $teacherCourse->firstWhere('id', $item->id);
            return $found == null;
        });

        return view('courseEdit', ['course' => $course, 'terms' => $terms, 'teacherCourse' => $teacherCourse, 'teachers' => $teachers]);
    }

    public function newCourse() {
        return view('courseEdit', ['course' => new Course()]);
    }

    public function createCourse(CourseRequest $request) {
        $course = Course::create([
            'shortcut' => $request->input('shortcut'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'capacity' => (int)$request->input('capacity'),
            'price' => (int)$request->input('price'),
            'guarantorID' => Auth::id()
        ]);

        TeacherCourse::create([
            'teacherID' => Auth::id(),
            'courseID'=> $course->id
        ]);

        return redirect('my-courses');
    }

    function updateCourse(CourseRequest $request, $id) {
        Course::find($id)->update([
            'shortcut' => $request->input('shortcut'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'capacity' => (int)$request->input('capacity'),
            'price' => (int)$request->input('price')
        ]);

        return redirect('my-courses');
    }

    function getTerm($courseId, $termId) {
        return view('termEdit', ['courseId' => $courseId, 'term' => Term::find($termId), 'rooms' => Classroom::all()]);
    }

    public function newTerm($courseId) {
        return view('termEdit', ['courseId' => $courseId, 'term' => new Term(), 'rooms' => Classroom::all()]);
    }

    function deleteCourseTerm(Request $request) {
        $toDelete = Term::find($request->input('id'));
        if (!$toDelete) return redirect('my-courses');
        $courseId = $toDelete->courseID;

        $toDelete->delete();
        return redirect('course-edit/'.$courseId);
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

    public function addTeacher($courseId, TeacherCourseRequest $request) {
        if ($request->input('teacher') != 'Nevybráno') {
            TeacherCourse::create([
                'teacherID' => $request->input('teacher'),
                'courseID' => $courseId
            ]);
        }
        return redirect('course-edit/'.$courseId);
    }

    public function deleteTeacher(Request $request) {
        $toDelete = TeacherCourse::find($request->input('id'));
        if (!$toDelete) return redirect('my-courses');
        $courseId = $toDelete->courseID;

        $toDelete->delete();
        return redirect('course-edit/'.$courseId);
    }

    public function getTermStudents (Request $request, $courseId, $termId) {
        $term = Term::where('id', $termId)->first();
        $students = StudentTerm::join('person', 'person.id', '=', 'studentID')
            ->where('termID', $termId)->get('person.*');

        return view('termStudents', [
            'courseId' => $courseId,
            'term' => $term,
            'students' => $students
        ]);
    }

    public function setTermStudents () {
        return back();
    }
}
