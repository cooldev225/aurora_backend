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
            $table->string('phone');
            $table->string('fax_number');
            $table->string('registration_number');
            $table->string('facility_number');
            $table->string('address');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('postcode');
            $table->string('country');
            $table->float('latitude');
            $table->float('longitude');
            $table->string('timezone');
            $table->enum('status', ['ACTIVE', 'INACTIVE'])
            $table->string('specimen_collection_point_number');
            $table->string('footnote_signature');
            $table->string('default_start_time');
            $table->string('default_end_time');
            $table->string('default_meal_time');
            $table->boolean('is_primary_centre');
            $table->string('latest_invoice_no');
            $table->string('latest_invoice_pathology_no');
            $table->string('centre_serial_no');
            $table->string('centre_last_invoice_serial_no');
            $table->integer('lspn_id');
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