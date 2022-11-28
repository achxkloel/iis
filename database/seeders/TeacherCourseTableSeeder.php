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
            ['teacherID' => 9, 'courseID' => 1],
            ['teacherID' => 9, 'courseID' => 2],
            ['teacherID' => 8, 'courseID' => 3],
            ['teacherID' => 8, 'courseID' => 4],
            ['teacherID' => 7, 'courseID' => 5],
            ['teacherID' => 7, 'courseID' => 6],
            ['teacherID' => 6, 'courseID' => 7],
            ['teacherID' => 6, 'courseID' => 8],
            ['teacherID' => 9, 'courseID' => 9],
            ['teacherID' => 9, 'courseID' => 10],
            ['teacherID' => 8, 'courseID' => 11],
            ['teacherID' => 8, 'courseID' => 12],
            ['teacherID' => 7, 'courseID' => 13],
            ['teacherID' => 7, 'courseID' => 14],
            ['teacherID' => 6, 'courseID' => 15],
            ['teacherID' => 6, 'courseID' => 16]
        ];

        TeacherCourse::insert($teacher_courses);
    }
}
