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
        Schema::create('specialist_clinic_relations', function (
            Blueprint $table
        ) {
            $table->id();
            $table->foreignId('specialist_id');
            $table->foreignId('clinic_id');
            $table->string('provider_number')->nullable();
            $table->string('healthlink_edi')->nullable();
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
        Schema::dropIfExists('specialist_clinic_relations');
    }
};
