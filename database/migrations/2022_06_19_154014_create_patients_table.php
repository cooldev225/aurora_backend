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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('UR_number')->nullable();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('home_number')->nullable();
            $table->string('work_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table
                ->enum('gender', ['Male', 'Female', 'Other', 'Undisclosed'])
                ->default('Male');
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table
                ->enum('marital_status', [
                    'Single',
                    'Divorced',
                    'Married',
                    'Widowed',
                ])
                ->default('Single');
            $table->string('birth_place_code')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->string('birth_state')->nullable();
            $table->string('allergies')->nullable();
            $table->boolean('aborginality')->default(0);
            $table->string('occupation')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->float('bmi')->nullable();
            $table
                ->enum('preferred_contact_method', [
                    'phone',
                    'sms',
                    'email',
                    'person',
                ])
                ->default('phone');
            $table
                ->enum('appointment_confirm_method', [
                    'sms',
                    'phone',
                    'email',
                    'person',
                    'other',
                ])
                ->default('sms');
            $table
                ->enum('send_recall_method', ['email', 'mail'])
                ->default('email');
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
        Schema::dropIfExists('patients');
    }
};
