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
        Schema::create('hrm_schedule_timeslots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hrm_weekly_schedule_template_id');
            $table->enum('week_day', ['MON','TUS','WED','THU','FRI','SAT','SUN']);
            $table->enum('category', ['WORKING','BREAK'])->default('WORKING');
            $table->enum('restriction', ['CONSULTATIONS','PROCEDURES','NONE'])->default('NONE');
            $table->time('start_time');
            $table->time('end_time');
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
        Schema::dropIfExists('hrm_schedule_timeslots');
    }
};