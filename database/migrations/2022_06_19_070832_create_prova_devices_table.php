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
        Schema::create('prova_devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_name');
            $table->string('otac');
            $table->string('private_key');
            $table->string('public_key');
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
        Schema::dropIfExists('prova_devices');
    }
};
