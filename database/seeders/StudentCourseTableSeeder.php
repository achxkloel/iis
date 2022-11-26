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
            ['studentID' => 2, 'courseID' => 1],
            ['studentID' => 2, 'courseID' => 2],
            ['studentID' => 2, 'courseID' => 3],
            ['studentID' => 2, 'courseID' => 4],
            ['studentID' => 5, 'courseID' => 4],
            ['studentID' => 5, 'courseID' => 2],
            ['studentID' => 5, 'courseID' => 3],
            ['studentID' => 6, 'courseID' => 1],
            ['studentID' => 6, 'courseID' => 2],
            ['studentID' => 7, 'courseID' => 2]
        ];

        StudentCourse::insert($student_courses);
    }
}