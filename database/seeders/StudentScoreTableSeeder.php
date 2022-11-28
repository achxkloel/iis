<?php

namespace Database\Seeders;

use App\Models\StudentScore;
use Illuminate\Database\Seeder;

class StudentScoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createDefaultStudentScore();
    }

    public function createDefaultStudentScore (): void {
        $student_scores = [
            ['teacherID' => 9, 'studentID' => 2, 'termID' => 2, 'score' => 75, 'created_at' => now(), 'updated_at' => now() ],
            ['teacherID' => 7, 'studentID' => 2, 'termID' => 4, 'score' => 6, 'created_at' => now(), 'updated_at' => now() ],
            ['teacherID' => 9, 'studentID' => 3, 'termID' => 8, 'score' => 60, 'created_at' => now(), 'updated_at' => now() ]
        ];

        StudentScore::insert($student_scores);
    }
}
