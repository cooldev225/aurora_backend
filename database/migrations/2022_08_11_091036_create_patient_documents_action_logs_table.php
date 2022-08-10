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
        Schema::create('patient_documents_action_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_document_id');
            $table->foreignId('user_id');
            $table->enum('status', [
                'EMAILED',
                'PRINTED',
                'FAXED',
            ]);
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
        Schema::dropIfExists('patient_documents_action_logs');
    }
};
