<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

    public function createDefaultUsers () {
        $users = [
            ['login' => 'admin', 'password' => Hash::make('admin'), 'name' => 'Admin', 'surname' => '', 'role' => 'admin', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()], // 'phone_number' => '789 456 132', 'email' => 'testing@mail.cz'
            ['login' => 'student', 'password' => Hash::make('student'), 'name' => 'Student', 'surname' => '', 'role' => 'student', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'teacher', 'password' => Hash::make('teacher'), 'name' => 'Teacher', 'surname' => '', 'role' => 'teacher', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['login' => 'guarantor', 'password' => Hash::make('guarantor'), 'name' => 'Guarantor', 'surname' => '', 'role' => 'guarantor', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()]
        ];

        Person::insert($users);
    }
}
