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
        Schema::create('anaesthetic_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table->foreignId('clinic_id');
            $table->string('question');
            $table->enum('status', ['enable', 'diable'])->default('enable');
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
        Schema::dropIfExists('anaesthetic_questions');
    }
};
