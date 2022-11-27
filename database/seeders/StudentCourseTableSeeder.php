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
            ['studentID' => 2, 'courseID' => 1, 'is_active'=> 1,'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 2, 'courseID' => 2, 'is_active'=> 1,'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 2, 'courseID' => 3, 'is_active'=> 1,'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 2, 'courseID' => 4, 'is_active'=> 1,'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'courseID' => 4, 'is_active'=> 1,'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'courseID' => 2, 'is_active'=> 1,'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'courseID' => 3, 'is_active'=> 1,'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 6, 'courseID' => 1, 'is_active'=> 1,'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 6, 'courseID' => 2, 'is_active'=> 1,'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 6, 'courseID' => 3, 'is_active'=> 0,'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 7, 'courseID' => 2, 'is_active'=> 1,'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 7, 'courseID' => 3, 'is_active'=> 0,'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 7, 'courseID' => 4, 'is_active'=> 0,'created_at' => now(), 'updated_at' => now()],
        ];

        StudentCourse::insert($student_courses);
    }
}