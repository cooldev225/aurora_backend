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
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('fax_number')->nullable();
            $table->string('hospital_provider_number')->nullable();
            $table->string('VAED_number')->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->string('timezone')->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->string('specimen_collection_point_number')->nullable();
            $table->string('footnote_signature')->nullable();
            $table->time('default_start_time')->nullable();
            $table->time('default_end_time')->nullable();
            $table->integer('default_meal_time')->nullable();
            $table->string('latest_invoice_no')->nullable();
            $table->string('latest_invoice_pathology_no')->nullable();
            $table->string('centre_serial_no')->nullable();
            $table->string('centre_last_invoice_serial_no')->nullable();
            $table->integer('lspn_id')->nullable();
            $table->integer('appointment_length')->nullable();
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
        Schema::dropIfExists('clinics');
    }
};
