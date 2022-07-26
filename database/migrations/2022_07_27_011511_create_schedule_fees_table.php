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
            $table->foreignId('organization_id');
            $table->boolean('allow_zero');
            $table->integer('item_number');
            $table->float('medicare_fee');
            $table->float('medicare_fee_75');
            $table->float('medicare_fee_85');
            $table->string('procedure_or_consultation');
            $table->float('dva_in');
            $table->float('dva_out');
            $table->float('tac');
            $table->float('work_cover');
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
        Schema::dropIfExists('schedule_fees');
    }
};
