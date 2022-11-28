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
            ['teacherID' => 9, 'studentID' => 2, 'termID' => 1, 'score' => 50, 'created_at' => now(), 'updated_at' => now() ],
            ['teacherID' => 9, 'studentID' => 2, 'termID' => 2, 'score' => 75, 'created_at' => now(), 'updated_at' => now() ],
            ['teacherID' => 8, 'studentID' => 2, 'termID' => 3, 'score' => 40, 'created_at' => now(), 'updated_at' => now() ],
            ['teacherID' => 8, 'studentID' => 2, 'termID' => 4, 'score' => 60, 'created_at' => now(), 'updated_at' => now() ],
        ];

        StudentScore::insert($student_scores);
    }
}
