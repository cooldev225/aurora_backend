<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('appointment_id');
            $table
                ->enum('charge_type', ['full-charge', 'other'])
                ->default('full-charge');
            $table->string('medicare_number')->nullable();
            $table->date('medicare_expiry_date')->nullable();
            $table->string('concession_number')->nullable();
            $table->date('concession_expiry_date')->nullable();
            $table->string('pension_number')->nullable();
            $table->date('pension_expiry_date')->nullable();
            $table->string('healthcare_card_number')->nullable();
            $table->date('healthcare_card_expiry_date')->nullable();
            $table->foreignId('health_fund_id')->default(0);
            $table->text('note')->nullable();
            $table->boolean('skip_coding')->default(false);
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
        Schema::dropIfExists('patient_billings');
    }
};
