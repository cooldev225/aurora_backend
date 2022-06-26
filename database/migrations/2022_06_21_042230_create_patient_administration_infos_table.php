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
            $table->text('note')->nullable();
            $table->text('important_details')->nullable();
            $table->string('allergies')->nullable();
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
        Schema::dropIfExists('patient_administration_infos');
    }
};
