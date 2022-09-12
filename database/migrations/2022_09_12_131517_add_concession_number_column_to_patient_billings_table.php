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
        Schema::table('patient_billings', function (Blueprint $table) {
            $table->string('concession_number')->after('medicare_expiry_date')->nullable();
            $table->date('concession_expiry_date')->after('concession_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_billings', function (Blueprint $table) {
            $table->dropColumn('concession_number');
            $table->dropColumn('concession_expiry_date');
        });
    }
};
