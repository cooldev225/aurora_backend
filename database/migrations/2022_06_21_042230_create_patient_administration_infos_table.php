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
        Schema::create('patient_administration_infos', function (
            Blueprint $table
        ) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('appointment_id');
            $table->foreignId('referring_doctor_id');
            $table->boolean('is_no_referral');
            $table
                ->enum('no_referral_reason', [
                    'emergency',
                    'in_hospital',
                    'lost_unavailable',
                    'not_required',
                ])
                ->default('emergency');
            $table->date('referal_date');
            $table->date('referal_expiry_date');
            $table->text('note')->nullable();
            $table->text('important_details')->nullable();
            $table->string('allergies')->nullable();
            $table->text('clinical_alerts')->nullable();
            $table->enum('receive_forms', ['sms', 'email'])->default('sms');
            $table->boolean('recurring_appointment')->default(false);
            $table
                ->enum('preferred_contact_method', [
                    'phone',
                    'sms',
                    'email',
                    'person',
                ])
                ->default('phone');
            $table->integer('aborginality')->default(0);
            $table->string('occupation')->nullable();
            $table->string('recent_service')->nullable();
            $table->string('outstanding_balance')->nullable();
            $table->string('further_details')->nullable();
            $table->string('fax_comment')->nullable();
            $table->text('anything_should_aware')->nullable();
            $table->string('collecting_person_name')->nullable();
            $table->string('collecting_person_phone')->nullable();
            $table->string('collecting_person_alternate_contact')->nullable();
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
        Schema::dropIfExists('patient_administration_infos');
    }
};
