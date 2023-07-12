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
        Schema::create('finesh_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("exam_id");
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');  

            $table->unsignedBigInteger("studentinfo_id");
            $table->foreign('studentinfo_id')->references('student_id')->on('studentinfos')->onDelete('cascade');  

            $table->timestampTz('start_exam')->nullable();
            $table->timestampTz('end_exam')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('start_exams');
    }
};
