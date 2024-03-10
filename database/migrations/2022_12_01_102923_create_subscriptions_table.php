<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')
                ->constrained('packages')
                ->onDelete('cascade');
            $table->foreignId('offer_id')
                ->constrained('offers')
                ->onDelete('cascade')->default(null);
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->dateTime('subscription_date', $precision = 0);
            $table->float('offer_discount')->default(0.0);
            $table->float('price')->default(0.0);
            $table->dateTime('expiration_date', $precision = 0);
            $table->integer('renewed_times')->default(0);
            $table->enum('pay_type', ['cash', 'visa']);
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
        Schema::dropIfExists('subscriptions');
    }
}
