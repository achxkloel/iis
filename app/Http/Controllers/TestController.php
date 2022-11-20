<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TestController
{
    public function get(): string {

        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        // });
        DB::table('person')->insert([
            'login' => 'test',
            'birth_number' => '30.11.2000',
            'name' => "Petr",
            "surname" => "Peringer"
        ]);
        
        return 'Steve';
    }
}
