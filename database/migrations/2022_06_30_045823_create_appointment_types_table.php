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
            $table->enum('type', ['Consultation', 'Procedure']);
            $table->string('color');
            $table->string('mbs_item_number');
            $table->string('mbs_description');
            $table->string('clinical_code');
            $table->string('name');
            $table->enum('invoice_by', ['Clinic', 'Specialist']);
            $table->integer('arrival_time');
            $table
                ->enum('appointment_time', ['Single', 'Double', 'Triple'])
                ->default('Single');
            $table->string('payment_tier_1');
            $table->string('payment_tier_2');
            $table->string('payment_tier_3');
            $table->string('payment_tier_4');
            $table->string('payment_tier_5');
            $table->string('payment_tier_6');
            $table->string('payment_tier_7');
            $table->string('payment_tier_8');
            $table->string('payment_tier_9');
            $table->string('payment_tier_10');
            $table->string('payment_tier_11');
            $table->boolean('anesthetist_required');
            $table->enum('status', ['Enabled', 'Disabled'])->default('Enabled');
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
