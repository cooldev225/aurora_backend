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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table->string('apt_start_time_slot')->nullable();
            $table->string('apt_end_time_slot')->nullable();
            $table->integer('total_time_diff')->default(0);
            $table->text('instructions')->default('');
            $table->text('notes')->default('');
            $table
                ->enum('type', [
                    'booking',
                    'check',
                    'checkout',
                    'specialist',
                    'billing',
                    'coding',
                    'pm',
                    'appointment_time_slot',
                    'redirect_url',
                    'recall_notify',
                    'voicemail_message',
                    'pre_admission_forms',
                ])
                ->default('booking');
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
        Schema::dropIfExists('settings');
    }
};
