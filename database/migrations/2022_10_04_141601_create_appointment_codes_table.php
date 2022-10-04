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
        Schema::create('appointment_codes', function (Blueprint $table) {
            $table->id();
            $table->text('procedures_undertaken');
            $table->text('extra_items_used'); 
            $table->text('indication_codes');
            $table->text('diagnosis_codes');
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
        Schema::dropIfExists('appointment_codes');
    }
};
