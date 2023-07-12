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
        Schema::create('degrees', function (Blueprint $table) {
            $table->id();
            $table->string('answer');
            $table->integer('score');
           
            $table->unsignedBigInteger("question_id");
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade'); 
         
            $table->unsignedBigInteger("studentinfo_id");
            $table->foreign('studentinfo_id')->references('student_id')->on('studentinfos')->onDelete('cascade');         
           
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
        Schema::dropIfExists('degrees');
    }
};
