<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id',false)->unsigned()->nullable();
            $table->string('mark_1')->nullable();
            $table->string('mark_2')->nullable();
            $table->string('mark_3')->nullable();
            $table->integer('total')->nullable();
            $table->string('rank')->nullable();
            $table->string('result')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('student_details')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_marks');
    }
}
