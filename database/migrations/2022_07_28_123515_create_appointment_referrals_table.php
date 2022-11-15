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
            $table->foreignId('doctor_address_book_id')->nullable();
            $table->foreignId('patient_document_id')->nullable();
            $table->boolean('is_no_referral')->default(false);
            
            $table
                ->enum('no_referral_reason', [
                    'EMERGENCY',
                    'IN_HOSPITAL',
                    'LOST_UNAVAILABLE',
                    'NOT_REQUIRED',
                ])
                ->default('EMERGENCY')
                ->nullable();

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
