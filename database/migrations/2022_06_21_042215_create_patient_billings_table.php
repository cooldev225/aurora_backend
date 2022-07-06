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
            $table->string('medicare_number')->nullable();
            $table->string('medicare_reference_number')->nullable();
            $table->date('medicare_expiry_date')->nullable();
            $table->string('concession_number')->nullable();
            $table->date('concession_expiry_date')->nullable();
            $table->string('pension_number')->nullable();
            $table->date('pension_expiry_date')->nullable();
            $table->string('healthcare_card_number')->nullable();
            $table->date('healthcare_card_expiry_date')->nullable();
            $table->foreignId('health_fund_id')->nullable();
            $table->string('health_fund_membership_number')->nullable();
            $table->string('health_fund_reference_number')->nullable();
            $table->date('health_fund_expiry_date')->nullable();
            $table
                ->enum('account_holder_type', ['Self', 'Other'])
                ->default('Self');

            $table->foreignId('account_holder_id')->nullable();
            $table->float('fund_excess')->nullable();
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
