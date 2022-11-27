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
            $table->string('abn_acn', 11)->nullable();
            $table->integer('max_clinics');
            $table->integer('max_employees');
            $table->string('billing_pin')->nullable();
            $table->foreignId('owner_id');

            $table->boolean('is_hospital')->default(true);
            $table->integer('appointment_length');
            $table->time('start_time');
            $table->time('end_time');

            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');

            $table->string('logo')->nullable();
            $table->boolean('has_billing')->default(true);
            $table->boolean('has_coding')->default(true);

            $table->integer('password_expiration_timeframe')->default(6);
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
