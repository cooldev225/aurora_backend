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
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table
                ->enum('type', [
                    'appointment_booked', 'appointment_confirmation',
                    'appointment_reminder', 'recall',
                    'procedure_approved','procedure_denied'
                ])
                ->default('recall');
            $table->string('title');
            $table->integer('days_before')->nullable();
            $table->string('subject')->nullable();
            $table->text('sms_template')->nullable();
            $table->text('email_print_template')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['enabled', 'disabled'])->default('enabled');
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
        Schema::dropIfExists('notification_templates');
    }
};
