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
        Schema::create('patient_recalls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('organization_id');
            $table->foreignId('appointment_id');
            $table->foreignId('patient_id');
            $table->integer('time_frame')->nullable();
            $table->date('date_recall_due');
            $table->boolean('confirmed')->default(false);
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('patient_recalls');
    }
};
