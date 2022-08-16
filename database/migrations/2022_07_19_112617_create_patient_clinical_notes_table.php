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
            $table->foreignId('patient_document_id');
            $table->foreignId('appointment_id');
            $table->text('description')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('clinical_assessment')->nullable();
            $table->text('treatment')->nullable();
            $table->text('history')->nullable();
            $table->text('additional_details')->nullable();
            $table->text('attached_documents')->nullable();
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
