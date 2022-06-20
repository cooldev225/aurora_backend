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
        Schema::create('health_funds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('fund')->nullable();
            $table->string('contact')->nullable();
            $table->boolean('is_online_eclipse')->default(true);
            $table->text('issues')->nullable();
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
        Schema::dropIfExists('health_funds');
    }
};
