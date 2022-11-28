<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Person;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createDefaultUsers();
    }

    public function createDefaultUsers (): void {
        $users = [
            ['login' => 'admin', 'password' => Hash::make('admin'), 'name' => 'Admin', 'surname' => 'admin', 'role' => 'admin', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],

            ['login' => 'student1', 'password' => Hash::make('student1'), 'name' => 'Student', 'surname' => 'One', 'role' => 'student', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'student2', 'password' => Hash::make('student2'), 'name' => 'Student', 'surname' => 'Two', 'role' => 'student', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'student3', 'password' => Hash::make('student3'), 'name' => 'Student', 'surname' => 'Three', 'role' => 'student', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'student4', 'password' => Hash::make('student4'), 'name' => 'Student', 'surname' => 'Four', 'role' => 'student', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],

            ['login' => 'teacher1', 'password' => Hash::make('teacher1'), 'name' => 'Teacher', 'surname' => 'One', 'role' => 'teacher', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'teacher2', 'password' => Hash::make('teacher2'), 'name' => 'Teacher', 'surname' => 'Two', 'role' => 'teacher', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'teacher3', 'password' => Hash::make('teacher3'), 'name' => 'Teacher', 'surname' => 'Three', 'role' => 'teacher', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'teacher4', 'password' => Hash::make('teacher4'), 'name' => 'Teacher', 'surname' => 'Four', 'role' => 'teacher', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()]
        ];

        Person::insert($users);

        // Add roles
        Person::where('login', 'admin')->first()->assignRole('admin', 'teacher', 'student');
        Person::where('login', 'teacher1')->first()->assignRole('teacher', 'student');
        Person::where('login', 'teacher2')->first()->assignRole('teacher', 'student');
        Person::where('login', 'teacher3')->first()->assignRole('teacher', 'student');
        Person::where('login', 'teacher4')->first()->assignRole('teacher', 'student');
        Person::where('login', 'student1')->first()->assignRole('student');
        Person::where('login', 'student2')->first()->assignRole('student');
        Person::where('login', 'student3')->first()->assignRole('student');
        Person::where('login', 'student4')->first()->assignRole('student');
    }
}
