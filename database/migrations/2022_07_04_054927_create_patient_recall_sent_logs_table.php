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
        Schema::create('patient_recall_sent_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_recall_id');
            $table->dateTime('recall_sent_at');
            $table->enum('sent_by', ['Mail', 'Email'])->default('Mail');
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
        Schema::dropIfExists('patient_recall_sent_logs');
    }
};
