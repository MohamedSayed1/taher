<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('home_meta_tags_ar', 255)->nullable();
            $table->string('home_meta_tags_nl', 255)->nullable();
            $table->char('home_meta_title_ar', 255)->nullable();
            $table->char('home_meta_title_nl', 255)->nullable();
            $table->char('sit_title_ar', 255)->nullable();
            $table->char('sit_title_nl', 255)->nullable();
            $table->string('home_meta_description_ar', 255)->nullable();
            $table->string('home_meta_description_nl', 255)->nullable();
            $table->string('home_meta_image', 255)->nullable();
            $table->char('facebook', 255)->nullable();
            $table->char('tweeter', 255)->nullable();
            $table->char('whatsapp', 255)->nullable();
            $table->char('youyube', 255)->nullable();
            $table->char('home_title_ar', 255)->nullable();
            $table->char('home_title_nl', 255)->nullable();
            $table->char('home_description_ar', 255)->nullable();
            $table->char('home_description_nl', 255)->nullable();
            $table->integer('test_exam_id')->nullable();
            $table->char('why_eltaher_desc_ar', 255)->nullable();
            $table->char('why_eltaher_desc_nl', 255)->nullable();
            $table->char('why_eltaher_first_title_ar', 255)->nullable();
            $table->char('why_eltaher_first_title_nl', 255)->nullable();
            $table->char('why_eltaher_first_desc_ar', 255)->nullable();
            $table->char('why_eltaher_first_desc_nl', 255)->nullable();
            $table->char('why_eltaher_secound_title_ar', 255)->nullable();
            $table->char('why_eltaher_secound_title_nl', 255)->nullable();
            $table->char('why_eltaher_secound_desc_ar', 255)->nullable();
            $table->char('why_eltaher_secound_desc_nl', 255)->nullable();
            $table->enum('lang', ['ar_nl', 'ar']);
            $table->char('reserve_exam_desc_ar', 255)->nullable();
            $table->char('reserve_exam_desc_nl', 255)->nullable();
            $table->char('footer_desc_ar', 255)->nullable();
            $table->char('footer_desc_nl', 255)->nullable();
            $table->char('main_phone', 255)->nullable();
            $table->char('secoundry_phone', 255)->nullable();
            $table->char('email', 255)->nullable();
            $table->char('address_ar', 255)->nullable();
            $table->char('address_nl', 255)->nullable();
            $table->double('lat')->nullable();
            $table->double('lon')->nullable();
            $table->char('exam_header_description_ar', 255)->nullable();
            $table->char('exam_header_description_nl', 255)->nullable();

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
        Schema::dropIfExists('settings');
    }
}
