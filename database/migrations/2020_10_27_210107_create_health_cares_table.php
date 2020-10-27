<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthCaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_cares', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('volume')->nullable();
            $table->date('created_date')->nullable();
            $table->string('symptom')->nullable();
            $table->string('timing')->nullable();
            $table->string('description')->nullable();
            $table->string('remark')->nullable();
            $table->boolean('status')->nullable();
            $table->string('hospital')->nullable();
            $table->string('province_id')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('health_cares');
    }
}
