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
        Schema::create('proda_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id');
            $table->string('device_name');
            $table->string('otac');
            $table->text('private_key');
            $table->text('public_key');
            $table
                ->enum('key_status', ['ACTIVE', 'INACTIVE'])
                ->default('ACTIVE');
            $table->date('key_expiry');
            $table
                ->enum('device_status', ['ACTIVE', 'INACTIVE'])
                ->default('ACTIVE');
            $table->date('device_expiry');
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
        Schema::dropIfExists('proda_devices');
    }
};
