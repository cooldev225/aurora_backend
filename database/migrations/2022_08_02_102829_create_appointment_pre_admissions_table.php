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
        Schema::create('appointment_pre_admissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id');
            $table->string('token');

            $table->enum('status', [
                'BOOKED',
                'VALIDATED',
                'CREATED',
            ])->default('BOOKED');

            $table->text('note')->nullable();

            $table->string('pre_admission_file')->nullable();

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
        Schema::dropIfExists('appointment_pre_admissions');
    }
};
