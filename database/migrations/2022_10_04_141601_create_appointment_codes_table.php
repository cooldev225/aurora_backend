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
        Schema::create('appointment_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id');
            $table->text('procedures_undertaken')->nullable();
            $table->text('extra_items_used')->nullable(); 
            $table->text('indication_codes')->nullable();
            $table->text('diagnosis_codes')->nullable();
            $table->boolean('is_complete')->default(false);
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
        Schema::dropIfExists('appointment_codes');
    }
};
