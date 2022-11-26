<?php

namespace Database\Seeders;

use App\Models\StudentTerm;
use Illuminate\Database\Seeder;

class StudentTermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createDefaultStudentTerm();
    }

    public function createDefaultStudentTerm (): void {
        $student_terms = [
            ['studentID' => 2, 'termID' => 1],
            ['studentID' => 2, 'termID' => 2],
            ['studentID' => 2, 'termID' => 3],
            ['studentID' => 2, 'termID' => 4],
            ['studentID' => 2, 'termID' => 7],
            ['studentID' => 2, 'termID' => 8],
            ['studentID' => 2, 'termID' => 9],
            ['studentID' => 5, 'termID' => 8],
            ['studentID' => 5, 'termID' => 9],
            ['studentID' => 5, 'termID' => 3],
            ['studentID' => 5, 'termID' => 5],
            ['studentID' => 5, 'termID' => 7],
            ['studentID' => 6, 'termID' => 1],
            ['studentID' => 6, 'termID' => 2],
            ['studentID' => 6, 'termID' => 3],
            ['studentID' => 6, 'termID' => 6],
            ['studentID' => 6, 'termID' => 7],
            ['studentID' => 7, 'termID' => 3],
            ['studentID' => 7, 'termID' => 4],
            ['studentID' => 7, 'termID' => 7]
        ];

        StudentTerm::insert($student_terms);
    }
}