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
        Schema::create('hrm_employee_leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('organization_id');
            $table->enum('status', ['Pending', 'Approved', 'Not Approved']);
            $table->enum('leave_type', ['Sick Leave', 'Annual Leave', 'Parental Leave', 'Personal Leave']);
            $table->string('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('full_day');
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
        Schema::dropIfExists('hrm_employee_leaves');
    }
};
