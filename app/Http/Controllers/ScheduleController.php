<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentTerm;

class ScheduleController
{
    public function get() {
        $monday = $this->getTermsByDay(1);
        $tuesday = $this->getTermsByDay(2);
        $wednesday = $this->getTermsByDay(3);
        $thursday = $this->getTermsByDay(4);
        $friday = $this->getTermsByDay(5);
        $other = $this->getTermsByDay();

        return view('schedule', [
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday,
            'other' => $other
        ]);
    }

    private function getTermsByDay ($day = '') {
        $query = StudentTerm::join('term', 'termID', '=', 'term.id')
            ->join('course', 'term.courseID', '=', 'course.id')
            ->where('student_term.studentID', Auth::id());

        if (!empty($day)) {
            $query->where('term.day', $day);
        } else {
            $query->whereNull('term.day');
        }
        
        return $query->get([
            'course.shortcut as courseShortcut',
            'course.id as courseID',
            'term.*'
        ]);
    }
}
