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
use App\Models\StudentScore;
use App\Models\Term;
use DateTime;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MyCoursesController
{
    public function get() {
        $foundCourses = Auth::user()->role == 'admin' ? Course::all() : Course::all()->where('guarantorID', Auth::id());
        return view('myCourses', ['courses' => $foundCourses]);
    }

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
        $course = Course::where('id', $courseId)->first();
        $term = Term::where('id', $termId)
            ->where('courseID', $courseId)
            ->first();

        if (!$course || !$term) {
            return abort(404);
        }

        $student_scores = StudentScore::select([
            'studentID',
            'termID',
            'score'
        ]);

        $students = StudentTerm::join('person', 'person.id', '=', 'student_term.studentID')
            ->leftJoinSub($student_scores, 'student_scores', function ($join) {
                $join->on('student_scores.studentID', '=', 'student_term.studentID');
                $join->on('student_scores.termID', '=', 'student_term.termID');
            })
            ->where('student_term.termID', $termId)->get([
                'person.*',
                'student_scores.score as studentScore'
            ]);

        return view('termStudents', [
            'course' => $course,
            'term' => $term,
            'students' => $students
        ]);
    }

    public function setTermScore (Request $request, $courseId, $termId) {
        $course = Course::where('id', $courseId)->first();
        $term = Term::where('id', $termId)
            ->where('courseID', $courseId)
            ->first();

        if (!$course || !$term) {
            return abort(404);
        }

        $data = $request->all();
        $errors = [];

        foreach ($data as $key => $value) {
            $value = trim($value);

            if (empty($value)) {
                continue;
            }

            if ($value != (int) $value) {
                $errors[$key] = true;
                continue;
            }

            $newScore = abs((int) $value);
            $studentID = (int) $key;

            if ($newScore > $term->score) {
                $newScore = $term->score;
            }

            $score = StudentScore::where('studentID', $studentID)
                ->where('termID', $termId);

            if (!$score->first()) {
                StudentScore::create([
                    'studentID' => $studentID,
                    'termID' => $termId,
                    'teacherID' => Auth::user()->id,
                    'score' => $newScore
                ]);
            } else {
                $score->update([
                    'score' => $newScore,
                    'teacherID' => Auth::user()->id
                ]);
            }
        }

        if (!empty($errors)) {
            return back()->withErrors($errors);
        }

        return back();
    }
}
