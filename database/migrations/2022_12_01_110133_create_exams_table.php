<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 255);
            $table->string('name_nl', 255)->nullable();
            $table->text('description_ar', 255);
            $table->text('description_nl', 255)->nullable();
            $table->integer('questions_num');
            $table->integer('attempt_num');
            $table->integer('duration_in_minutes');
            $table->integer('wrong_question_to_fail');
            $table->boolean('exam_category_auto_move');
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
        Schema::dropIfExists('exams');
    }
}
