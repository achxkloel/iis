<?php

namespace Database\Seeders;

use App\Models\TeacherCourse;
use Illuminate\Database\Seeder;

class TeacherCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createDefaultTeacherCourse();
    }

    public function createDefaultTeacherCourse (): void {
        $classes = [
            ['name' => 'Domaci uloha', 'description' => 'Domaci uloha', 'type' => 'practical', 'capacity' => 0, 'floor' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'A100', 'description' => 'Short description', 'type' => 'practical', 'capacity' => 20, 'floor' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'B100', 'description' => 'Short description', 'type' => 'laboratory', 'capacity' => 10, 'floor' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'C200', 'description' => 'Short description', 'type' => 'auditorium', 'capacity' => 200, 'floor' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'D300', 'description' => 'Short description', 'type' => 'auditorium', 'capacity' => 100, 'floor' => 3, 'created_at' => now(), 'updated_at' => now()]
        ];

        TeacherCourse::insert($classes);
    }
}