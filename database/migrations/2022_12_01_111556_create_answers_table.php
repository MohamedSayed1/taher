<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->text('answer_ar');
            $table->text('answer_nl')->nullable();
            $table->text('answer_image')->nullable();
            $table->text('main_answer')->nullable();
            $table->foreignId('question_id')
                ->constrained('questions')
                ->onDelete('cascade');
            $table->boolean('right_answer')->default(0);
            $table->integer('top_position')->nullable();
            $table->integer('left_position')->nullable();
            $table->integer('arrangment')->default(1);
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
        Schema::dropIfExists('answers');
    }
}
