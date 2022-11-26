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
            ['teacherID'=>4, 'studentID' => 2, 'termID' => 2, 'score' =>50 ],
            ['teacherID'=>4, 'studentID' => 6, 'termID' => 2, 'score' =>75 ],
            ['teacherID'=>10,'studentID' => 2, 'termID' => 7, 'score' =>40 ],
            ['teacherID'=>10,'studentID' => 5, 'termID' => 7, 'score' =>60 ],
            ['teacherID'=>10,'studentID' => 6, 'termID' => 7, 'score' =>20 ],
            ['teacherID'=>10,'studentID' => 7, 'termID' => 7, 'score' =>0 ],
            ['teacherID'=>4,'studentID' => 2, 'termID' => 8, 'score' =>50 ],
            ['teacherID'=>4,'studentID' => 5, 'termID' => 8, 'score' =>86 ],
            ['teacherID'=>10,'studentID' => 2, 'termID' => 9, 'score' =>50 ],
            ['teacherID'=>10,'studentID' => 5, 'termID' => 9, 'score' =>43 ],
            ['teacherID'=>9,'studentID' => 2, 'termID' => 4, 'score' =>5 ],
            ['teacherID'=>9,'studentID' => 7, 'termID' => 4, 'score' =>10 ],
            ['teacherID'=>4,'studentID' => 5, 'termID' => 5, 'score' =>1 ],
            ['teacherID'=>3,'studentID' => 6, 'termID' => 6, 'score' =>7 ]
        ];

        StudentScore::insert($student_scores);
    }
}