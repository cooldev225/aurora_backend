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
        Schema::create('appointment_administration_infos', function (
            Blueprint $table
        ) {
            $table->id();
            $table->foreignId('appointment_id')->index();
            $table->text('note')->nullable();
            $table->text('important_details')->nullable();
            $table->text('clinical_alerts')->nullable();
            $table->enum('receive_forms', ['sms', 'email'])->default('sms');
            $table->boolean('recurring_appointment')->default(false);
            $table->string('recent_service')->nullable();
            $table->string('outstanding_balance')->nullable();
            $table->text('further_details')->nullable();
            $table->text('fax_comment')->nullable();
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
        Schema::dropIfExists('appointment_administration_infos');
    }
};
