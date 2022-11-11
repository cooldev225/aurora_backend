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
        Schema::create('hrm_deleted_schedules', function (Blueprint $table) {
            $table->id();
            $table->time('start_time');
            $table->date('date');
            $table->time('end_time');
            $table->foreignId('organization_id');
            $table->foreignId('clinic_id');
            $table->foreignId('user_id');
            $table->string('reason');
            $table->enum('week_day', ['MON','TUE','WED','THU','FRI','SAT','SUN']);
            $table->enum('category', ['WORKING','BREAK']);
            $table->enum('restriction', ['CONSULTATION','PROCEDURE','NONE']);
            $table->enum('status',['PUBLISHED','UNPUBLISHED','CANCELED']);
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
        Schema::dropIfExists('hrm_deleted_schedules');
    }
};
