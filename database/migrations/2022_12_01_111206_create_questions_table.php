<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question_ar');
            $table->text('question_nl')->nullable();
            $table->text('question_uuid');
            $table->foreignId('exam_category_id')
                ->constrained('exam_categories')
                ->onDelete('cascade');
            $table->foreignId('exam_id')
                ->constrained('exams')
                ->onDelete('cascade');
            $table->enum('question_type', ['mcq','mcq_image', 'text_input', 'drag_drop'])->default('mcq');
            $table->text('question_image')->nullable();
            $table->integer('arrangment')->default(1);
            $table->text('answer_explanation_ar', 255)->nullable();
            $table->text('answer_explanation_nl', 255)->nullable();
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
        Schema::dropIfExists('questions');
    }
}
