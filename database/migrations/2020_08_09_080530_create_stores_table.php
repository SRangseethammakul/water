<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('store_name')->nullable();
            $table->string('store_tel')->unique()->nullable();
            $table->string('store_address')->nullable();
            $table->string('store_lat')->nullable();
            $table->string('store_lng')->nullable();
            $table->string('store_contact')->nullable();
            $table->string('store_tax_id')->nullable();
            $table->string('store_tax_name')->nullable();
            $table->string('store_tax_contact')->nullable();
            $table->string('store_detail')->nullable();
            $table->string('store_promotion')->nullable();
            $table->string('store_price_sum')->nullable();
            $table->string('store_status')->nullable();
            $table->string('store_province')->nullable();
            $table->string('store_amphure')->nullable();
            $table->string('store_image')->nullable();
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
        Schema::dropIfExists('stores');
    }
}
