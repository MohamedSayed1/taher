<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 255);
            $table->string('name_nl', 255)->nullable();
            $table->text('description_ar', 255)->nullable();
            $table->text('description_nl', 255)->nullable();
            $table->integer('questions_num')->default(0);
            $table->foreignId('exam_id')
                ->constrained('exams')
                ->onDelete('cascade');
            $table->enum('duration_type', ['for_question', 'for_category'])->default('for_question');
            $table->integer('duration')->default(8);
            $table->integer('arrangment')->default(1);
            $table->boolean('explaination_while_exam')->default(1);
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
        Schema::dropIfExists('exam_categories');
    }
}
