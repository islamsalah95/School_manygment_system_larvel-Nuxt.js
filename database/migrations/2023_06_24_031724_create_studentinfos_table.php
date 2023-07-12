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
        Schema::create('studentinfos', function (Blueprint $table) {
            $table->unsignedBigInteger("student_id")->primary();;
            $table->unsignedBigInteger("grade_id");
            $table->unsignedBigInteger("classroom_id");
            $table->unsignedBigInteger("section_id");
            $table->unsignedBigInteger("parent_id");
            $table->string("Nationality");
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');  
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');  
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');  
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');  
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studentinfos');
    }
};
