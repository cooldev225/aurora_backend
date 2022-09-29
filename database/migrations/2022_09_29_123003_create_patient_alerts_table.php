<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('created_by');
            $table->enum('alert_level',['NOTICE', 'WARNING','BLACKLISTED'])->default('NOTICE');
            $table->boolean('is_dismissed')->default(false);
            $table->text('explanation');
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
        Schema::dropIfExists('patient_alerts');
    }
};
