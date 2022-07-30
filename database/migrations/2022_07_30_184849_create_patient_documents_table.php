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
            ])->default('LETTER');

            $table->foreignId('created_by');
            $table->string('file_path');
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
