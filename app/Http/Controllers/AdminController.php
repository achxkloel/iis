<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\StudentScore;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\CreateClassRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Requests\SetPasswordPersonRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function showPersons () {
        return view('admin.persons', ['persons' => Person::all()]);
    }

    public function showClasses () {
        return view('admin.classes', ['classes' => Classroom::all()]);
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
            ->where('student_course.studentID', $person->id)
            ->get([
                'course.*',
                'student_course.updated_at as registered_at',
                'total_score'
            ]);

        // Get person cources as a teacher
        $teacher_courses = Course::join('teacher_course', 'course.id', '=', 'courseID')
            ->where('teacherID', $person->id)
            ->get([
                'course.*',
                'teacher_course.updated_at as registered_at'
            ]);

        return view('admin.person', [
            'person' => $person,
            'student_courses' => $student_courses,
            'teacher_courses' => $teacher_courses
        ]);
    }

    public function showPersonForm () {
        return view('admin.personCreate');
    }

    public function showClassForm () {
        return view('admin.classCreate');
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

        return back()->with([
            'success' => true,
            'login' => $data['login'],
            'password' => $password
        ]);
    }

    public function createNewClass (CreateClassRequest $request) {
        $data = $request->validated();

        Classroom::create($data);

        return redirect()->route('admin-classes')->with([
            'success' => true,
            'name' => $data['name']
        ]);
    }

    public function deletePerson (Request $request) {
        Person::where('id', $request->input('id'))->delete();
        return back();
    }

    public function deleteClass (Request $request) {
        Classroom::where('id', $request->input('id'))->delete();
        return back();
    }

    private function getRolesList (string $role) {
        $additional_roles = [];

        switch ($role) {
            case 'guarantor':
                $additional_roles = ['teacher', 'student'];
                break;
            case 'teacher':
                $additional_roles = ['student'];
                break;
        }

        return array_push($additional_roles, $role);
    }

    public function updatePerson (UpdatePersonRequest $request, $personId) {
        $data = $request->validated();

        $birth_date = Carbon::createFromFormat('d.m.Y', $data['birth_date']);
        $birth_date->setTimeFromTimeString('00:00:00');
        $data['birth_date'] = $birth_date;

        Person::where('id', $personId)->update($data);
        return back();
    }

    public function setNewPassword (SetPasswordPersonRequest $request, $personId) {
        $data = $request->validated();
        Person::where('id', $personId)->update(['password' => Hash::make($data['newPassword'])]);
        return back();
    }
}