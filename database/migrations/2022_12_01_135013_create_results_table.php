<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('exam_id')
                ->constrained('exams')
                ->onDelete('cascade');
            $table->integer('attempt_num')->default(0);
            $table->float('score')->default(0.0);
            $table->longText('json_score')->nullable();
            $table->boolean('passed_exam')->default(0);
            $table->integer('total_current_questions')->default(0);
            $table->integer('total_right_questions')->default(0);
            $table->integer('total_wrong_questions')->default(0);
            $table->integer('total_skiped_questions')->default(0);
            $table->integer('total_not_answered_questions')->default(0);
            $table->integer('total_flaged_questions')->default(0);
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
        Schema::dropIfExists('results');
    }
}
