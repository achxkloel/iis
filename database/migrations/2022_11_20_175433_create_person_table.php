<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login', 255)->unique();
            $table->string('birth_number', 255);
            $table->string('name', 255);
            $table->string('surname', 255);
            $table->string('address', 255)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone_number', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('role', 255)->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person');
    }
};
