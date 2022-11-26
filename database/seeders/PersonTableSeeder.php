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
            ['login' => 'admin', 'password' => Hash::make('admin'), 'name' => 'Admin', 'surname' => '', 'role' => 'admin', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()], // 'phone_number' => '789 456 132', 'email' => 'testing@mail.cz'
            ['login' => 'student', 'password' => Hash::make('student'), 'name' => 'Student', 'surname' => '', 'role' => 'student', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'teacher', 'password' => Hash::make('teacher'), 'name' => 'Teacher', 'surname' => '', 'role' => 'teacher', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'guarantor', 'password' => Hash::make('guarantor'), 'name' => 'Guarantor', 'surname' => '', 'role' => 'guarantor', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],

            ['login' => 'student1', 'password' => Hash::make('student1'), 'name' => 'Student1', 'surname' => '', 'role' => 'student', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'student2', 'password' => Hash::make('student2'), 'name' => 'Student2', 'surname' => '', 'role' => 'student', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'student3', 'password' => Hash::make('student3'), 'name' => 'Student3', 'surname' => '', 'role' => 'student', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            ['login' => 'teacher1', 'password' => Hash::make('teacher1'), 'name' => 'Teacher1', 'surname' => '', 'role' => 'teacher', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'teacher2', 'password' => Hash::make('teacher2'), 'name' => 'Teacher2', 'surname' => '', 'role' => 'teacher', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            ['login' => 'guarantor1', 'password' => Hash::make('guarantor1'), 'name' => 'Guarantor1', 'surname' => '', 'role' => 'guarantor', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()]
        ];

        Person::insert($users);

        // Add roles
        Person::where('login', 'admin')->first()->assignRole('admin', 'guarantor', 'teacher', 'student');
        Person::where('login', 'guarantor')->first()->assignRole('guarantor', 'teacher', 'student');
        Person::where('login', 'teacher')->first()->assignRole('teacher', 'student');
        Person::where('login', 'student')->first()->assignRole('student');
    }
}
