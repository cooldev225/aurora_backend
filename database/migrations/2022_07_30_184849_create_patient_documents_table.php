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
            $table->foreignId('organization_id');
            $table->foreignId('patient_id')->nullable();
            $table->foreignId('appointment_id')->nullable();
            $table->foreignId('specialist_id')->nullable();
            $table->string('document_name')->nullable();
            $table->longText('document_body')->nullable();
            $table->enum('document_type', [
                'LETTER',
                'REPORT',
                'CLINICAL_NOTE',
                'PATHOLOGY_REPORT',
                'REFERRAL',
                'AUDIO',
                'USB_CAPTURE',
                'OTHER'
            ])->default('LETTER');

            $table->enum('file_type', [
                'PNG',
                'PDF',
                'HTML',
                'OTHER',
            ])->default('OTHER');

            $table->enum('origin', [
                'CREATED',
                'RECEIVED',
                'UPLOADED',
            ])->default('CREATED');

            $table->foreignId('created_by');
            $table->string('file_path')->nullable();
            $table->boolean('is_updatable')->default(false);
            $table->boolean('is_read')->default(false);
            $table->boolean('is_urgent')->default(true);
            $table->boolean('is_incorrectly_assigned')->default(false);
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
