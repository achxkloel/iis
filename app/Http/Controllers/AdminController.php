<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\StudentScore;
use App\Models\StudentCourse;
use App\Models\StudentTerm;
use App\Models\TeacherCourse;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\CreateClassRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Requests\SetPasswordPersonRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showPersons () {
        return view('admin.persons', ['persons' => Person::all()]);
    }

    public function showClasses () {
        return view('admin.classes', ['classes' => Classroom::all()]);
    }

    public function showClass (Request $request, $classId) {
        $class = Classroom::where('id', $classId)->first();

        if (!$class) {
            return abort(404);
        }

        return view('admin.classEdit', ['class' => $class]);
    }

    public function showPerson (Request $request, $personId) {
        $person = Person::where('id', $personId)->first();

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
            ->where('student_course.studentID', $person->id)->where('student_course.is_active', true)
            ->get([
                'course.*',
                'student_course.updated_at as registered_at',
                'total_score',
                'student_course.id as studentCourseID'
            ]);

        // Get person cources as a teacher
        $teacher_courses = Course::join('teacher_course', 'course.id', '=', 'courseID')
            ->where('teacherID', $person->id)
            ->get([
                'course.*',
                'teacher_course.updated_at as registered_at',
                'teacher_course.id as teacherCourseID'
            ]);

        $student_courses_add = Course::whereNotIn('id', $student_courses->pluck('id')->all())
            ->where('is_confirmed', true)
            ->get([
                'course.id',
                'course.shortcut',
                'course.name'
            ]);

        $teacher_courses_add = Course::whereNotIn('id', $teacher_courses->pluck('id')->all())
            ->get([
                'course.id',
                'course.shortcut',
                'course.name'
            ]);

        return view('admin.person', [
            'person' => $person,
            'student_courses' => $student_courses,
            'teacher_courses' => $teacher_courses,
            'student_courses_add' => $student_courses_add,
            'teacher_courses_add' => $teacher_courses_add
        ]);
    }

    public function deletePersonTeacherCourse (Request $request) {
        $toDelete = TeacherCourse::find($request->input('id'));
        if (!$toDelete) return redirect()->route('admin-persons');
        $personId = $toDelete->teacherID;
        $toDelete->delete();
        return redirect()->route('admin-person', $personId);
    }

    public function deletePersonStudentCourse (Request $request) {
        $toDelete = StudentCourse::find($request->input('id'));
        if (!$toDelete) return redirect()->route('admin-persons');
        $personId = $toDelete->studentID;
        $courseId = $toDelete->courseID;

        // Delete student term
        StudentTerm::join('term', 'term.id', '=', 'termID')
            ->where('studentID', $personId)
            ->where('courseID', $courseId)
            ->delete();

        // Delete student score
        StudentScore::join('term', 'term.id', '=', 'termID')
            ->where('studentID', $personId)
            ->where('courseID', $courseId)
            ->delete();
        
        $toDelete->delete();
        return redirect()->route('admin-person', $personId);
    }

    public function showPersonForm () {
        return view('admin.personCreate');
    }

    public function showClassForm () {
        return view('admin.classCreate');
    }

    public function addPersonStudentCourse (Request $request, $personId) {
        if ($request->input('student_course') != 'Nevybráno') {
            StudentCourse::create([
                'studentID' => $personId,
                'courseID' => $request->input('student_course'),
                'is_active' => true
            ]);
        }
        return redirect()->route('admin-person', $personId);
    }

    public function addPersonTeacherCourse (Request $request, $personId) {
        if ($request->input('teacher_course') != 'Nevybráno') {
            TeacherCourse::create([
                'teacherID' => $personId,
                'courseID' => $request->input('teacher_course')
            ]);
        }
        return redirect()->route('admin-person', $personId);
    }

    public function createNewPerson (CreatePersonRequest $request) {
        $data = $request->validated();

        if (Person::where('login', $data['login'])->exists()) {
            return back()
                ->withErrors([
                    'error' => true,
                ])
                ->withInput();
        }

        $password = Str::random(20);

        $person = Person::create([
            'login' => $data['login'],
            'password' => Hash::make($password),
            'name' => $data['name'],
            'surname' => $data['surname'],
            'role' => $data['role']
        ]);

        $person->assignRole($this->getRolesList($data['role']));

        return redirect()->route('admin-persons')->with([
            'success' => true,
            'login' => $data['login'],
            'password' => $password
        ]);
    }

    public function createNewClass (CreateClassRequest $request) {
        $data = $request->validated();

        Classroom::create($data);

        return redirect()->route('admin-classes')->with([
            'success_create' => true,
            'name' => $data['name']
        ]);
    }

    public function updateClass (CreateClassRequest $request, $classId) {
        $data = $request->validated();

        Classroom::where('id', $classId)->update($data);

        return redirect()->route('admin-classes')->with([
            'success_update' => true,
            'name' => $data['name']
        ]);
    }

    public function deletePerson (Request $request) {
        if ((int) $request->input('id') == Auth::user()->id) {
            back();
        }
        
        Person::where('id', $request->input('id'))->delete();
        return back();
    }

    public function deleteClass (Request $request) {
        Classroom::where('id', $request->input('id'))->delete();
        return back();
    }

    private function getRolesList (string $role) {
        $additional_roles = ($role == 'teacher') ? ['student'] : [];

        return array_push($additional_roles, $role);
    }

    public function updatePerson (UpdatePersonRequest $request, $personId) {
        $data = $request->validated();

        if ($data['birth_date'] != NULL) {
            $birth_date = Carbon::createFromFormat('d.m.Y', $data['birth_date']);
            $birth_date->setTimeFromTimeString('00:00:00');
            $data['birth_date'] = $birth_date;
        }

        Person::where('id', $personId)->update($data);
        return back();
    }

    public function setNewPassword (SetPasswordPersonRequest $request, $personId) {
        $data = $request->validated();
        Person::where('id', $personId)->update(['password' => Hash::make($data['newPassword'])]);
        return back();
    }

    public function confirmCourse (Request $request, $courseId) {
        Course::where('id', $courseId)->update([
            'is_confirmed' => true
        ]);

        return redirect()->route('my-courses');
    }
}
