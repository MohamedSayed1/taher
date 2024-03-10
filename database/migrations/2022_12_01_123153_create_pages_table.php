<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar', 100);
            $table->string('title_nl', 100)->nullable();
            $table->string('slug_ar', 255);
            $table->string('slug_nl', 255)->nullable();
            $table->text('tags_ar');
            $table->text('tags_nl')->nullable();
            $table->longText('body_ar')->nullable();
            $table->longText('body_nl')->nullable();
            $table->boolean('enabel')->default(1);
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
        Schema::dropIfExists('pages');
    }
}
