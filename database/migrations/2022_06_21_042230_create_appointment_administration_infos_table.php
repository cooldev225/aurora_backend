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
            $table->text('clinical_alerts')->nullable();
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
