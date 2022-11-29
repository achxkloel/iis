<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Requests\TeacherCourseRequest;
use App\Http\Requests\TermRequest;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Person;
use App\Models\StudentCourse;
use App\Models\TeacherCourse;
use App\Models\StudentTerm;
use App\Models\StudentScore;
use App\Models\Term;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class MyCoursesController
{
    public function getTeachingCourses() {
        $teachingCourses = Course::all()->where('is_confirmed', true);
        $unconfirmedCourses = Course::all()->where('is_confirmed', false);

        if(Auth::user()->role != 'admin') {
            $teachingCourses = Course::join('teacher_course', 'course.id', '=', 'courseID')->where('teacherID', Auth::id())->where('is_confirmed', true)->get('course.*');
            $unconfirmedCourses = Course::all()->where('guarantorID', Auth::id())->where('is_confirmed', false);
        }
        return view('myCourses', ['unconfirmedcourses' => $unconfirmedCourses,'teachingcourses' => $teachingCourses]);
    }

    public function getCourse($id) {
        $course = Course::find($id);
        if (!$course) {
            return abort(404);
        }
        $terms = Term::all()->where('courseID', $id);
        $teacherCourse = TeacherCourse::all()->where('courseID', $id);

        $teachers = Person::all()->where('role', 'teacher');

        $teachers = $teachers->filter(function ($item) use ($teacherCourse) {
            $found = $teacherCourse->firstWhere('teacherID', $item->id);
            return $found == null;
        });

        return view('courseEdit', ['course' => $course, 'terms' => $terms, 'teacherCourse' => $teacherCourse, 'teachers' => $teachers, 'days' => ['Po', 'Út', 'St', 'Čt', 'Pá']]);
    }

    public function getTeacherCourse($id) {
        $course = Course::find($id);
        if (!$course) {
            return abort(404);
        }
        $terms = Term::all()->where('courseID', $id);
        $students = Person::join('student_course', 'person.id', '=', 'studentID')
        ->where('courseID', $id)->get();

        return view('teachercourseoverview', ['course' => $course, 'terms' => $terms, 'students' => $students, 'days' => ['Po', 'Út', 'St', 'Čt', 'Pá']]);
    }

    public function newCourse() {
        return view('courseEdit', ['course' => new Course()]);
    }

    public function createCourse(CourseRequest $request) {
        $data = $request->validated();

        $date_from = Carbon::createFromFormat('d.m.Y', $data['date_from']);
        $date_to = Carbon::createFromFormat('d.m.Y', $data['date_to']);
        $date_from->setTimeFromTimeString('00:00:00');
        $date_to->setTimeFromTimeString('00:00:00');

        $course = Course::create([
            'shortcut' => $data['shortcut'],
            'name' => $data['name'],
            'description' => $data['description'],
            'capacity' => (int) $data['capacity'],
            'price' => (int) $data['price'],
            'date_from' => $date_from,
            'date_to' => $date_to,
            'guarantorID' => Auth::id()
        ]);

        TeacherCourse::create([
            'teacherID' => Auth::id(),
            'courseID'=> $course->id
        ]);

        return redirect('my-courses');
    }

    function updateCourse(CourseRequest $request, $id) {
        $data = $request->validated();

        $date_from = Carbon::createFromFormat('d.m.Y', $data['date_from']);
        $date_to = Carbon::createFromFormat('d.m.Y', $data['date_to']);
        $date_from->setTimeFromTimeString('00:00:00');
        $date_to->setTimeFromTimeString('00:00:00');

        Course::find($id)->update([
            'shortcut' => $data['shortcut'],
            'name' => $data['name'],
            'description' => $data['description'],
            'capacity' => (int) $data['capacity'],
            'price' => (int) $data['price'],
            'date_from' => $date_from,
            'date_to' => $date_to,
        ]);

        return redirect('my-courses');
    }

    function deleteCourse(Request $request) {
        $toDelete = Course::find($request->input('id'));
        if (!$toDelete) return redirect('my-courses');

        $toDelete->delete();
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
        $course = Course::all()->where('id', $id)->first();
        $studentCourse = StudentCourse::all()->where('courseID', $id)->where('is_active', 0);

        return view('registrationManagement', ['course' => $course, 'studentCourse' => $studentCourse]);
    }

    function confirmRegistration($courseId, $studentCourseId) {
        StudentCourse::find($studentCourseId)->update(['is_active' => 1]);
        return redirect('registration-management/'.$courseId);
    }

    function deleteRegistration($courseId, $studentCourseId) {
        StudentCourse::find($studentCourseId)->delete();
        return redirect('registration-management/'.$courseId);
    }

    function confirmAllRegistrations($courseId) {
        StudentCourse::where('courseID', $courseId)->update(['is_active' => 1]);
        return redirect('registration-management/'.$courseId);
    }

    function deleteAllRegistrations($courseId) {
        StudentCourse::where('courseID', $courseId)->delete();
        return redirect('registration-management/'.$courseId);
    }

    /**
     * @throws Exception
     */
    public function createTerm(TermRequest $request, $courseId) {
        $data = $request->validated();

        Term::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'description' => $data['description'],
            'score' => (int)$data['score'],
            'capacity' => (int)$data['capacity'],
            'duration_from' => $data['duration_from'],
            'duration_to' => $data['duration_to'],
            'day' => $data['day'],
            'courseID' => $courseId,
            'classID' => $request->input('room') != 0 ? $request->input('room') : null,
            'teacherID' => Auth::id()
        ]);

        return redirect('course-edit/'.$courseId);
    }

    function updateTerm(TermRequest $request, $courseId, $termId) {
        $data = $request->validated();
        
        Term::find($termId)->update([
            'name' => $data['name'],
            'type' => $data['type'],
            'description' => $data['description'],
            'score' => (int)$data['score'],
            'capacity' => (int)$data['capacity'],
            'duration_from' => $data['duration_from'],
            'duration_to' => $data['duration_to'],
            'day' => $data['day'],
            'courseID' => $courseId,
            'classID' => $request->input('room') != 0 ? $request->input('room') : null,
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
                'student_term.id as studentTermId',
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

            if ($key != (int) $key) {
                continue;
            }

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

    public function deleteStudent(Request $request) {
        $toDelete = StudentCourse::find($request->input('id'));
        if (!$toDelete) return redirect('my-courses');
        $courseId = $toDelete->courseID;

        $toDelete->delete();
        return redirect('teacher-course-overview/'.$courseId);
    }

    public function deleteStudentTerm(Request $request) {
        $toDelete = StudentTerm::find($request->input('id'));
        if (!$toDelete) return redirect('my-courses');
        $courseId = $request->input('courseId');
        $termId = $toDelete->termID;

        $toDelete->delete();
        return redirect('course/'.$courseId.'/term/'.$termId);
    }
}
