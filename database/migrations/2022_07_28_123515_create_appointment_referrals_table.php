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
            $table->foreignId('referring_doctor_id');
            $table->boolean('is_no_referral')->index();
            
            $table
                ->enum('no_referral_reason', [
                    'EMERGENCY',
                    'IN_HOSPITAL',
                    'LOST_UNAVAILABLE',
                    'NOT_REQUIRED',
                ])
                ->default('emergency')
                ->nullable();

            $table->date('referral_date')->nullable();
            $table->string('referral_duration')->nullable();
            $table->date('referral_expiry_date')->nullable();
            $table->string('referral_file')->nullable();
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
