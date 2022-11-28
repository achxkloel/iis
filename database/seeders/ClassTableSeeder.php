<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createDefaultClassrooms();
    }

    public function createDefaultClassrooms (): void {
        $classes = [
            ['name' => 'Domácí úloha', 'description' => 'Domaci uloha', 'type' => 'practical', 'capacity' => 0, 'floor' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'A100', 'description' => 'Short description', 'type' => 'practical', 'capacity' => 20, 'floor' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'B100', 'description' => 'Short description', 'type' => 'laboratory', 'capacity' => 10, 'floor' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'C200', 'description' => 'Short description', 'type' => 'auditorium', 'capacity' => 200, 'floor' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'D300', 'description' => 'Short description', 'type' => 'auditorium', 'capacity' => 100, 'floor' => 3, 'created_at' => now(), 'updated_at' => now()]
        ];

        Classroom::insert($classes);
    }
}