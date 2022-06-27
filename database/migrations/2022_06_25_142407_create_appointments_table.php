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
            $table->foreignId('anaethetist_id');
            $table->integer('reference_number')->default(0);
            $table
                ->enum('status', [
                    'Pending',
                    'Confirmed',
                    'Success',
                    'Waiting',
                    'Cancel',
                    'Deleted',
                ])
                ->default('Pending');
            $table
                ->enum('checkin_status', ['waiting', 'checkin', 'checkout'])
                ->default('waiting');
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
