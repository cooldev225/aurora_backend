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
        Schema::create('hrm_weekly_schedules', function (Blueprint $table) {
            $table->id();
            $table->time('start_time');
            $table->date('date');
            $table->time('end_time');
            $table->foreignId('organization_id');
            $table->foreignId('hrm_schedule_timeslot_id')->nullable();;
            $table->foreignId('clinic_id');
            $table->foreignId('user_id');
            $table->foreignId('anesthetist_id')->nullable();
            $table->foreignId('hrm_filled_week_id')->nullable();
            $table->enum('week_day', ['MON','TUE','WED','THU','FRI','SAT','SUN']);
            $table->enum('category', ['WORKING','BREAK'])->default('WORKING');
            $table->enum('restriction', ['CONSULTATION','PROCEDURE','NONE'])->default('NONE');
            $table->boolean('is_template');
            $table->enum('status',['PUBLISHED','UNPUBLISHED','CANCELED'])->default('UNPUBLISHED');
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
        Schema::dropIfExists('hrm_weekly_schedules');
    }
};
