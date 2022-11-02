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
        Schema::create('schedule_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->string('health_fund_code', 3);
            $table->string('mbs_item_code');
            $table->foreignId('organization_id');
            $table->timestamps();

            $table->unique(['health_fund_code', 'mbs_item_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_fees');
    }
};
