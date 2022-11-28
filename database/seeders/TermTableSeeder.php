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
            ['name' => 'IJA Prednaska', 'description' => 'Short description', 'type' => 'lecture', 'score' => 0, 'date_from' => '2022-09-01', 'date_to' => '2022-12-12', 'capacity' => 100, 'open' => 1, 'courseID' => 1, 'classID' => 5, 'teacherID' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'IJA projekt', 'description' => 'Short description', 'type' => 'project', 'score' => 100, 'date_from' => '2022-09-01', 'date_to' => '2022-11-28', 'capacity' => 200, 'open' => 1,'courseID' => 1, 'classID'=> 1, 'teacherID' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ITU Prednaska', 'description' => 'Short description', 'type' => 'lecture','score' => 0, 'date_from' => '2022-09-01', 'date_to' => '2022-12-12', 'capacity' => 200, 'open' => 1, 'courseID' => 2, 'classID' => 4, 'teacherID' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ITU cviceni', 'description' => 'Short description', 'type' => 'practical', 'score' => 10, 'date_from' => '2022-09-01', 'date_to' => '2022-10-12', 'capacity' => 20, 'open' => 1, 'courseID' => 2, 'classID' => 2, 'teacherID' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ITU cviceni', 'description' => 'Short description', 'type' => 'practical', 'score' => 10, 'date_from' => '2022-09-01', 'date_to' => '2022-10-12', 'capacity' => 20, 'open' => 1, 'courseID' => 2, 'classID' => 2, 'teacherID' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ITU cviceni', 'description' => 'Short description', 'type' => 'practical', 'score' => 10, 'date_from' => '2022-09-01', 'date_to' => '2022-10-12', 'capacity' => 20, 'open' => 1, 'courseID' => 2, 'classID' => 2, 'teacherID' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ITU projekt', 'description' => 'Short description', 'type' => 'project', 'score' => 90, 'date_from' => '2022-09-01', 'date_to' => '2022-12-14', 'capacity' => 200, 'open' => 1, 'courseID' => 2, 'classID'=> 1, 'teacherID' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'IIS Prednaska', 'description' => 'Short description', 'type' => 'lecture', 'score' => 100, 'date_from' => '2022-09-01', 'date_to' => '2022-12-12', 'capacity' => 200, 'open' => 1, 'courseID' => 3, 'classID' => 4, 'teacherID' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ISS Prednaska', 'description' => 'Short description', 'type' => 'lecture', 'score' => 100, 'date_from' => '2022-09-01', 'date_to' => '2022-12-12', 'capacity' => 200, 'open' => 1, 'courseID' => 4, 'classID' => 4, 'teacherID' => 9, 'created_at' => now(), 'updated_at' => now()]
        ];

        Term::insert($terms);
    }
}
