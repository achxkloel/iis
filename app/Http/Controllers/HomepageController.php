<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomepageController
{
    public function getCourses(Request $request) {
        $courses = Course::all();
        $fulltextString = $request->query('fulltext');

        $courses = $courses->filter(function ($course) use ($fulltextString) {
            return str_contains($course->shortcut, $fulltextString) || str_contains($course->name, $fulltextString);
        });

        return view('homepage', ['courses' => $courses]);
    }
}
