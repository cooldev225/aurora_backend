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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->integer('max_clinics');
            $table->integer('max_employees');
            $table->foreignId('owner_id');

            $table->boolean('is_hospital')->default(true);
            $table->integer('appointment_length');
            $table->time('start_time');
            $table->time('end_time');

            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');

            $table->string('logo')->nullable();
            $table->string('document_letter_header')->nullable();
            $table->string('document_letter_footer')->nullable();

            $table->boolean('has_billing')->default(true);
            $table->boolean('has_coding')->default(true);

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
        Schema::dropIfExists('organizations');
    }
};
