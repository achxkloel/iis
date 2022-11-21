<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            ['login' => 'admin', 'password' => Hash::make('admin'), 'name' => 'Admin', 'surname' => '', 'role' => 'admin', 'phone_number' => '789 456 132', 'email' => 'testing@mail.cz'],
            ['login' => 'student', 'password' => Hash::make('student'), 'name' => 'Student', 'surname' => '', 'role' => 'student'],
            ['login' => 'teacher', 'password' => Hash::make('teacher'), 'name' => 'Teacher', 'surname' => '', 'role' => 'teacher'],
            ['login' => 'guarantor', 'password' => Hash::make('guarantor'), 'name' => 'Guarantor', 'surname' => '', 'role' => 'guarantor'],
        ];

        DB::table('person')->upsert($users, ['login']);
    }
}
