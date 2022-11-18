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
        Schema::create('doctor_address_books', function (Blueprint $table) {

            $table->id();
            $table->string('organization_id');
            $table->string('provider_no');
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('practice_address');
            $table->string('practice_name');
            $table->string('practice_phone');
            $table->string('practice_fax')->nullable();
            $table->string('practice_email');
            $table->string('healthlink_edi')->nullable();
            $table->enum('preferred_communication_method', ['EMAIL','FAX', 'HEALTHLINK'])->default('EMAIL');
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
        Schema::dropIfExists('doctor_address_books');
    }
};
