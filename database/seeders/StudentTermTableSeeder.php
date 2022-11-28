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
            ['studentID' => 2, 'termID' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 2, 'termID' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 3, 'termID' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 3, 'termID' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 3, 'termID' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 4, 'termID' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 4, 'termID' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 4, 'termID' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 4, 'termID' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'termID' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'termID' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'termID' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['studentID' => 5, 'termID' => 6, 'created_at' => now(), 'updated_at' => now()]
        ];

        StudentTerm::insert($student_terms);
    }
}
