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
        Schema::create('patient_recalls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialist_id');
            $table->foreignId('organization_id');
            $table->foreignId('patient_id');
            $table->foreignId('appointment_id');
            $table->foreignId('notification_template_id');
            $table->text('recalled_text');
            $table->date('recall_sent_date');
            $table->text('recall_note')->nullable();
            $table->date('appointment_date');
            $table
                ->enum('status', [
                    'Upcoming',
                    'Sent',
                    'Failed',
                    'Done',
                    'Overdue',
                ])
                ->default('Upcoming');
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
        Schema::dropIfExists('patient_recalls');
    }
};
