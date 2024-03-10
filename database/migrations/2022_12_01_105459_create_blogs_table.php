<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar', 255);
            $table->string('slug_ar', 255);
            $table->string('title_nl', 255)->nullable();
            $table->string('slug_nl', 255)->nullable();
            $table->foreignId('blog_category_id')
                ->constrained('blog_categories')
                ->onDelete('cascade');
            $table->text('description_ar')->nullable();
            $table->text('description_nl')->nullable();
            $table->longText('body_ar')->nullable();
            $table->longText('body_nl')->nullable();
            $table->longText('tags_ar')->nullable();
            $table->longText('tags_nl')->nullable();
            $table->longText('image')->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
