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
        Schema::create('appointment_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table->enum('type', ['CONSULTATION', 'PROCEDURE'])->default('procedure');
            $table->boolean('anesthetist_required')->default(false);
            $table->string('color')->nullable();
            $table->string('name');
            $table->enum('invoice_by', ['CLINIC', 'SPECIALIST'])->default('CLINIC');
            $table->integer('arrival_time');
            $table->enum('appointment_time', ['SINGLE', 'DOUBLE', 'TRIPLE'])->default('SINGLE');
            $table->integer('payment_tier_1')->default(0);
            $table->integer('payment_tier_2')->default(0);
            $table->integer('payment_tier_3')->default(0);
            $table->integer('payment_tier_4')->default(0);
            $table->integer('payment_tier_5')->default(0);
            $table->integer('payment_tier_6')->default(0);
            $table->integer('payment_tier_7')->default(0);
            $table->integer('payment_tier_8')->default(0);
            $table->integer('payment_tier_9')->default(0);
            $table->integer('payment_tier_10')->default(0);
            $table->integer('payment_tier_11')->default(0);
            $table->foreignId('report_template')->nullable();
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
        Schema::dropIfExists('appointment_types');
    }
};
