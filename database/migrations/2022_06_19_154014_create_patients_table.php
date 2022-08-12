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
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table
                ->enum('gender', ['Male', 'Female', 'Other', 'Undisclosed'])
                ->default('Undisclosed');
            $table->date('date_of_birth');
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('suburb')->nullable();
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
                    'Undisclosed',
                ])
                ->default('Undisclosed');
            $table->string('birth_place_code')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->string('birth_state')->nullable();
            $table->string('allergies')->nullable();
            $table->boolean('aborginality')->default(false);
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
                ->enum('send_recall_method', ['sms', 'email'])
                ->default('sms');
            $table->string('kin_name')->nullable();
            $table->string('kin_relationship')->nullable();
            $table->string('kin_phone_number')->nullable();
            $table->text('clinical_alerts')->nullable();
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
