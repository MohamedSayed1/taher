<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamOpinionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_opinions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')->nullable();
            $table->foreignId('exam_id')
                ->constrained('exams')
                ->onDelete('cascade');
            $table->foreignId('question_id')
                ->constrained('questions')
                ->onDelete('cascade');
            $table->enum('problem_type', ['image_upload', 'lang_error', 'another_problem'])->default('image_upload');
            $table->text('problem_descreption')->nullable();
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
        Schema::dropIfExists('exam_opinions');
    }
}
