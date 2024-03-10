<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->text('question_ar');
            $table->text('question_nl')->nullable();
            $table->longText('answer_ar');
            $table->longText('answer_nl')->nullable();
            $table->boolean('enable')->default(1);
            $table->integer('arrangment')->default(1);
            $table->enum('faq_type', ['faq', 'sympol', 'theory_info'])->default('faq');
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
        Schema::dropIfExists('faqs');
    }
}
