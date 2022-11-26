<?php

namespace App\Http\Controllers;

use App\Models\Course;

class HomepageController
{
    public function getAllCourses() {
        return Course::all();
    }
}
