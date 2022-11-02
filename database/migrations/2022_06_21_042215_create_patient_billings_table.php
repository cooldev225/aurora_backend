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
            $table->string('member_number');
            $table->string('member_reference_number')->nullable();
            $table->string('health_fund_id', 3)->nullable();
            $table->tinyInteger('billing_type');
            $table->boolean('has_medicare_concession')->default(false);
            $table->boolean('is_valid')->default(false);
            $table->timestamp('verified_at')->nullable();
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
