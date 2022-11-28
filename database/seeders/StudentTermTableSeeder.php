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
            ['studentID' => 3, 'termID' => 7],
            ['studentID' => 3, 'termID' => 8],
            ['studentID' => 3, 'termID' => 9],
            ['studentID' => 3, 'termID' => 8],
            ['studentID' => 4, 'termID' => 9],
            ['studentID' => 4, 'termID' => 3],
            ['studentID' => 4, 'termID' => 5],
            ['studentID' => 4, 'termID' => 7],
            ['studentID' => 5, 'termID' => 1],
            ['studentID' => 5, 'termID' => 2],
            ['studentID' => 5, 'termID' => 3],
            ['studentID' => 5, 'termID' => 6]
        ];

        StudentTerm::insert($student_terms);
    }
}
