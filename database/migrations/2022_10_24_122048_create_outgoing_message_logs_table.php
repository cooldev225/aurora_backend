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
        Schema::create('outgoing_message_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('send_method', ['HEALTHLINK', 'EMAIL', 'FAX']);
            $table->text('sending_doctor_name');
            $table->text('sending_doctor_provider');
            $table->text('receiving_doctor_name');
            $table->text('receiving_doctor_provider');
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
        Schema::dropIfExists('outgoing_message_logs');
    }
};
