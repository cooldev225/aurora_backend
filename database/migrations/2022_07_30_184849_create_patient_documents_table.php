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
        Schema::create('patient_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('appointment_id')->nullable();
            $table->foreignId('specialist_id')->nullable();

            $table->enum('document_type', [
                'LETTER',
                'REPORT',
                'CLINICAL_NOTE',
                'PATHOLOGY_REPORT',
                'AUDIO',
                'USB_CAPTURE',
                'OTHER'
            ])->default('LETTER');

            $table->enum('file_type', [
                'IMAGE',
                'PDF',
                'OTHER',
            ])->default('IMAGE');

            $table->enum('origin', [
                'CREATED',
                'RECEIVED',
                'UPLOADED',
            ])->default('CREATED');

            $table->foreignId('created_by');
            $table->string('file_path')->nullable();
            $table->boolean('is_updatable')->default(true);

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
        Schema::dropIfExists('patient_documents');
    }
};
