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
        Schema::create('appointment_referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->index();
            $table->date('referral_date')->nullable();
            $table->string('referral_duration')->nullable();
            $table->date('referral_expiry_date')->nullable();
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
        Schema::dropIfExists('appointment_referrals');
    }
};
