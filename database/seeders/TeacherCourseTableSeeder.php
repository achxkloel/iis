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
            ['teacherID' => 8, 'courseID' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 4, 'courseID' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 4, 'courseID' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 9, 'courseID' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 3, 'courseID' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 10, 'courseID' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 10, 'courseID' => 4, 'created_at' => now(), 'updated_at' => now()]
        ];

        TeacherCourse::insert($teacher_courses);
    }
}
