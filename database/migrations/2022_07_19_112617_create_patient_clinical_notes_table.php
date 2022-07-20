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
        Schema::create('patient_clinical_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id');
            $table->text('description');
            $table->text('diagnosis');
            $table->text('clinical_assessment');
            $table->text('treatment');
            $table->text('history');
            $table->text('additional_details');
            $table->text('attached_documents');
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
        Schema::dropIfExists('patient_clinical_notes');
    }
};
