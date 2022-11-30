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
        Schema::create('appointment_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id');
            $table->foreignId('confirmed_by');
            $table->integer('amount');
            $table->enum('payment_type', ['CASH', 'EFTPOS'])->default('CASH');
            $table->boolean('is_deposit')->default(false);
            $table->boolean('is_send_receipt')->default(false);
            $table->enum('notification_method', ['email', 'sms'])->nullable();
            $table->text('sent_to')->nullable();
            $table->integer('invoice_number');
            $table->foreignId('authorized_by')->nullable();
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
        Schema::dropIfExists('appointment_payments');
    }
};
