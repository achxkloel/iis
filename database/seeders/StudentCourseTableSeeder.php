<?php

namespace Database\Seeders;

use App\Models\StudentCourse;
use Illuminate\Database\Seeder;

class StudentCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createDefaultStudentCourse();
    }

    public function createDefaultStudentCourse (): void {
        $student_courses = [
            ['studentID' => 2, 'courseID' => 1, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 2, 'courseID' => 2, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 2, 'courseID' => 3, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 2, 'courseID' => 4, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 2, 'courseID' => 5, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 2, 'courseID' => 6, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 3, 'courseID' => 4, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 3, 'courseID' => 5, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 3, 'courseID' => 6, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 3, 'courseID' => 7, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 3, 'courseID' => 8, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 3, 'courseID' => 9, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 4, 'courseID' => 7, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 4, 'courseID' => 8, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 4, 'courseID' => 9, 'is_active' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 4, 'courseID' => 10, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 4, 'courseID' => 11, 'is_active' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 4, 'courseID' => 12, 'is_active' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'courseID' => 10, 'is_active' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'courseID' => 11, 'is_active' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'courseID' => 12, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'courseID' => 13, 'is_active' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'courseID' => 14, 'is_active' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'courseID' => 15, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'courseID' => 16, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
        ];

        StudentCourse::insert($student_courses);
    }
}
