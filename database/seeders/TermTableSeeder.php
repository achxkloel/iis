<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Seeder;

class TermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createDefaultTerms();
    }

    public function createDefaultTerms (): void {
        $terms = [
            ['name' => 'IJA Prednaska', 'description' => '', 'type' => 'Prednáška', 'score' => 0, 'duration_from' => 8, 'duration_to' => 10 , 'day'=> 1, 'capacity' => 100, 'open' => 1, 'courseID' => 1, 'classID' => 5, 'teacherID' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'IJA projekt', 'description' => '', 'type' => 'Projekt', 'score' => 100, 'duration_from' => NULL, 'duration_to' => NULL , 'day'=> NULL, 'capacity' => 200, 'open' => 1,'courseID' => 1, 'classID'=> 1, 'teacherID' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ITU Prednaska', 'description' => '', 'type' => 'Prednáška','score' => 0, 'duration_from' => 13, 'duration_to' => 17 , 'day'=> 2, 'capacity' => 200, 'open' => 1, 'courseID' => 2, 'classID' => 4, 'teacherID' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ITU cviceni', 'description' => '', 'type' => 'Cvičení', 'score' => 10, 'duration_from' => 12, 'duration_to' => 13 , 'day'=> 3, 'capacity' => 20, 'open' => 1, 'courseID' => 2, 'classID' => 2, 'teacherID' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ITU cviceni', 'description' => '', 'type' => 'Cvičení', 'score' => 10, 'duration_from' => 12, 'duration_to' => 13 , 'day'=> 4, 'capacity' => 20, 'open' => 1, 'courseID' => 2, 'classID' => 2, 'teacherID' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ITU cviceni', 'description' => '', 'type' => 'Cvičení', 'score' => 10, 'duration_from' => 12, 'duration_to' => 13 , 'day'=> 3, 'capacity' => 20, 'open' => 1, 'courseID' => 2, 'classID' => 3, 'teacherID' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ITU projekt', 'description' => '', 'type' => 'Projekt', 'score' => 90, 'duration_from' => NULL, 'duration_to' => NULL , 'day'=> NULL, 'capacity' => 200, 'open' => 1, 'courseID' => 2, 'classID'=> 1, 'teacherID' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'IIS Prednaska', 'description' => '', 'type' => 'Prednáška', 'score' => 100, 'duration_from' => 8, 'duration_to' => 12 , 'day'=> 1, 'capacity' => 200, 'open' => 1, 'courseID' => 3, 'classID' => 4, 'teacherID' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ISS Prednaska', 'description' => '', 'type' => 'Prednáška', 'score' => 100, 'duration_from' => 15, 'duration_to' => 18 , 'day'=> 5, 'capacity' => 200, 'open' => 1, 'courseID' => 4, 'classID' => 4, 'teacherID' => 9, 'created_at' => now(), 'updated_at' => now()]
        ];

        Term::insert($terms);
    }
}
