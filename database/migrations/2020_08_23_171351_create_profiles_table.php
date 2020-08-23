<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('lineid')->unique()->nullable();
            $table->string('profile_tel')->unique()->nullable();
            $table->string('profile_tel_2')->nullable();
            $table->string('profile_address')->nullable();
            $table->string('profile_province')->nullable();
            $table->string('profile_amphure')->nullable();
            $table->string('profile_zipcode')->nullable();
            $table->string('profile_lat')->nullable();
            $table->string('profile_lng')->nullable();
            $table->string('profile_tax_address')->nullable();
            $table->string('profile_sortorder')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
