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
        Schema::create('term', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type');
            $table->integer('score');
            $table->dateTime('date_from');
            $table->dateTime('date_to');
            $table->integer('capacity');
            $table->integer('open')->default(0);
            $table->integer('courseID');
            $table->integer('classID')->nullable();
            $table->integer('teacherID');
            $table->timestamps();
            $table->foreign('courseID')->references('id')->on('course');
            $table->foreign('classID')->references('id')->on('class');
            $table->foreign('teacherID')->references('id')->on('person');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('term');
    }
};
