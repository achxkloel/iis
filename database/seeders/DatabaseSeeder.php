<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PersonTableSeeder::class,
            CourseTableSeeder::class,
            ClassTableSeeder::class,
            TermTableSeeder::class,
            TeacherCourseTableSeeder::class,
            StudentCourseTableSeeder::class,
            StudentTermTableSeeder::class,
            StudentScoreTableSeeder::class
        ]);
    }
}
