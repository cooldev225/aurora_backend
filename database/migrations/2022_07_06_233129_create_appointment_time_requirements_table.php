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
        Schema::create('appointment_time_requirements', function (
            Blueprint $table
        ) {
            $table->id();
            $table->foreignId('organization_id');
            $table->string('title');
            $table->enum('type', ['Before', 'After'])->default('Before');
            $table->time('base_time');
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
        Schema::dropIfExists('appointment_time_requirements');
    }
};
