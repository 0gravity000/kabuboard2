<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stock_id');
            $table->date('date');
            $table->double('price')->nullable();
            $table->double('pre_end_price')->nullable();
            $table->double('start_price')->nullable();
            $table->double('end_price')->nullable();
            $table->double('highest_price')->nullable();
            $table->double('lowest_price')->nullable();
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
        Schema::dropIfExists('daily_prices');
    }
}
