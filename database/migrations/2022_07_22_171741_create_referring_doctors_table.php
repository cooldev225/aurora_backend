<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referring_doctors', function (Blueprint $table) {
            $table->id();
            $table->string('provider_no');
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('postcode');
            $table->string('phone');
            $table->string('fax');
            $table->string('mobile');
            $table->string('email');
            $table->string('practice_name');
            $table->string('upload_file_name')->nullable();

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
        Schema::dropIfExists('referring_doctors');
    }
};
