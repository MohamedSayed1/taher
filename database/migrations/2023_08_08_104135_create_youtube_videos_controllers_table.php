<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYoutubeVideosControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtube_videos_controllers', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar', 255);
            $table->string('title_nl', 255)->nullable();
            $table->string('title_en', 255)->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_nl')->nullable();
            $table->text('description_en')->nullable();
            $table->longText('video_link')->nullable();
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
        Schema::dropIfExists('youtube_videos_controllers');
    }
}
