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
        Schema::create('patient_specialist_audios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_document_id');
            $table->foreignId('patient_id');
            $table->foreignId('specialist_id');
            $table->string('file_path')->nullable();
            $table->foreignId('translated_by');
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
        Schema::dropIfExists('patient_specialist_audios');
    }
};
