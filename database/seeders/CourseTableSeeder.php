<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createDefaultCourses();
    }

    public function createDefaultCourses (): void {
        $courses = [
            ['shortcut' => 'IJA', 'name' => 'Seminar Java', 'description' => 'Short description', 'capacity' => 5, 'guarantorID' => 4, 'is_confirmed' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['shortcut' => 'ITU', 'name' => 'Tvorba uzivatelskych rozhrani', 'description' => 'Short description', 'capacity' => 5, 'guarantorID' => 4, 'is_confirmed' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['shortcut' => 'IIS', 'name' => 'Informacni systemy', 'description' => 'Short description', 'capacity' => 5, 'guarantorID' => 10, 'is_confirmed' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['shortcut' => 'ISS', 'name' => 'Signaly a systemy', 'description' => 'Short description', 'capacity' => 5, 'guarantorID' => 10, 'is_confirmed' => 1, 'created_at' => now(), 'updated_at' => now()]
        ];

        Course::insert($courses);
    }
}
