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
        Schema::create('student_score', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacherID');
            $table->integer('studentID');
            $table->integer('termID');
            $table->integer('score')->default(0);
            $table->timestamps();
            $table->foreign('teacherID')->references('id')->on('person');
            $table->foreign('studentID')->references('id')->on('person');
            $table->foreign('termID')->references('id')->on('term');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_score');
    }
};
