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
            $table->string('shortcut', 255)->unique();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('type', 255);
            $table->integer('price')->nullable();
            $table->integer('capacity');
            $table->integer('public')->default(0);
            $table->integer('guarantorID');
            $table->foreign('guarantorID')->references('id')->on('person');
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
