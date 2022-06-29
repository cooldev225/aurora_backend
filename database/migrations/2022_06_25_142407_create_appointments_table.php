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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('organization_id');
            $table->foreignId('clinic_id');
            $table->foreignId('procedure_id');
            $table->foreignId('primary_pathologist_id');
            $table->foreignId('specialist_id');
            $table->foreignId('room_id');
            $table->foreignId('anesthetist_id');
            $table->integer('reference_number')->default(0);
            $table->boolean('is_waitlisted')->default(false);
            $table
                ->enum('procedure_approval_status', [
                    'NOT_ACCESSED',
                    'NOT_APPROVED',
                    'APPROVED',
                ])
                ->default('NOT_ACCESSED');
            $table
                ->enum('confirmation_status', [
                    'PENDING',
                    'CONFIRMED',
                    'CANCELED',
                    'MISSED',
                ])
                ->default('PENDING');
            $table
                ->enum('attendance_status', [
                    'NOT_PRESENT',
                    'WAITING',
                    'CHECKED_IN',
                    'CHECKED_OUT',
                ])
                ->default('NOT_PRESENT');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('actual_start_time')->nullable();
            $table->time('actual_end_time')->nullable();
            $table
                ->enum('payment_status', ['pending', 'paid', 'failed'])
                ->default('pending');
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
        Schema::dropIfExists('appointments');
    }
};
