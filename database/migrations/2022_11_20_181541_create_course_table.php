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
        Schema::create('course', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shortcut')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price')->nullable();
            $table->integer('capacity');
            $table->integer('guarantorID');
            $table->integer('is_confirmed')->default(0);
            $table->timestamps();
            $table->foreign('guarantorID')->references('id')->on('person')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course');
    }
};
