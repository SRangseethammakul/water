<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_subs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade')->nullable();
            $table->integer('product_id')->unsigned();
            $table->integer('qty')->insigned();
            $table->decimal('price',10,2);
            $table->decimal('total',10,2);
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
        Schema::dropIfExists('order_subs');
    }
}
