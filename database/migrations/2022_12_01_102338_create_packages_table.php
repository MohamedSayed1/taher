<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 100);
            $table->string('name_nl', 100)->nullable();
            $table->text('notes_ar')->nullable();
            $table->text('notes_nl')->nullable();
            $table->text('badge_ar')->nullable();
            $table->text('badge_nl')->nullable();
            $table->boolean('show_in_home')->default(true);
            $table->integer('exam_count')->default(0);
            $table->integer('arrangement')->default(0);
            $table->float('price')->default(0.0);
            $table->integer('expiration_duration_in_dayes')->default(1);
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
        Schema::dropIfExists('packages');
    }
}
