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
            ['teacherID' => 9, 'courseID' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 6, 'courseID' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 9, 'courseID' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 6, 'courseID' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 8, 'courseID' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 7, 'courseID' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 8, 'courseID' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 7, 'courseID' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 8, 'courseID' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 7, 'courseID' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 8, 'courseID' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 7, 'courseID' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 9, 'courseID' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 6, 'courseID' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 9, 'courseID' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 6, 'courseID' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 6, 'courseID' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 9, 'courseID' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 6, 'courseID' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 9, 'courseID' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 7, 'courseID' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 8, 'courseID' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 7, 'courseID' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 8, 'courseID' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 8, 'courseID' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 7, 'courseID' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 8, 'courseID' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 7, 'courseID' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 9, 'courseID' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 6, 'courseID' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 9, 'courseID' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['teacherID' => 6, 'courseID' => 16, 'created_at' => now(), 'updated_at' => now()]
        ];

        TeacherCourse::insert($teacher_courses);
    }
}
