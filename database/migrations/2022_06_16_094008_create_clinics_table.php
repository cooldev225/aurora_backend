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
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('fax_number')->nullable();
            $table->string('hospital_provider_number')->nullable();
            $table->string('VAED_number')->nullable();
            $table->string('address')->nullable();
            $table->string('specimen_collection_point_number')->nullable();
            $table->integer('lspn_id')->nullable();
            $table->string('document_letter_header')->nullable();
            $table->string('document_letter_footer')->nullable();

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
        Schema::dropIfExists('clinics');
    }
};
