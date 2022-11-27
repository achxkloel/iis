<?php

namespace Database\Seeders;

use App\Models\TeacherCourse;
use Illuminate\Database\Seeder;

class TeacherCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createDefaultTeacherCourse();
    }

    public function createDefaultTeacherCourse (): void {
        $teacher_courses = [
            ['teacherID' => 8, 'courseID' => 1],
            ['teacherID' => 4, 'courseID' => 1],
            ['teacherID' => 4, 'courseID' => 2],
            ['teacherID' => 9, 'courseID' => 2],
            ['teacherID' => 3, 'courseID' => 2],
            ['teacherID' => 10, 'courseID' => 3],
            ['teacherID' => 10, 'courseID' => 4]
        ];

        TeacherCourse::insert($teacher_courses);
    }
}
