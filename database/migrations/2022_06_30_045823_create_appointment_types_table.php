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
        Schema::create('appointment_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table->enum('type', ['CONSULTATION', 'PROCEDURE'])->default('procedure');
            $table->boolean('anesthetist_required')->default(false);
            $table->string('color')->nullable();
            $table->string('name');
            $table->enum('invoice_by', ['CLINIC', 'SPECIALIST'])->default('CLINIC');
            $table->integer('arrival_time');
            $table->enum('appointment_time', ['SINGLE', 'DOUBLE', 'TRIPLE'])->default('SINGLE');
            $table->json('default_items')->nullable();
            $table->foreignId('report_template')->nullable();
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
        Schema::dropIfExists('appointment_types');
    }
};
