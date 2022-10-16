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
            $table->foreignId('appointment_id');
            $table->text('procedures_undertaken')->nullable();
            $table->text('extra_items_used')->nullable(); 
            $table->text('indication_codes')->nullable();
            $table->text('diagnosis_codes')->nullable();
            $table->enum('vaed_admission_type', ['K','S','Y','M','C','O','P'])->default('P');  //Admission Type See in VAED manual sec 3
            $table->enum('vaed_admission_source', ['K','S','Y','T','B','A','N','H','Q'])->default('H');  //Admission Source See in VAED manual sec 3
            $table->enum('vaed_account_class', 
            ['KK','NT','MP','ME','MF','MN','M5','MA', 'JP','JN','PA',
             'PB','PC','PD','PE','PF','PG','PH','PI','PJ','PK','PL',
             'PO', 'PP','PQ','PR','PS','PT','PU','PV','VX','VN','V5',
             'WC','WN','TA', 'TN','AS','AN','SS','SN','CL','CN','OO',
             'ON', 'XX','XN'])->default('PO');  //Account Class See in VAED manual sec 3
            $table->enum('vaed_accommodation_type', ['R','4','7','S','M','H','P','6','K','U', 'N','A','B','3','2','1'])->default('3');  //Accommodation Type See in VAED manual sec 3
            $table->enum('vaed_separation_mode', ['G','S','D','Z','T','B','A','J', 'L','H', 'C'])->default('H');  //Separation mode See in VAED manual sec 3
            $table->enum('vaed_care_type', ['10','1','P','6','8','5T','5E','5K','5G','5S','5A','9','MC','0','4','U'])->default('4');  //Care type See in VAED manual sec 3
            $table->boolean('is_complete')->default(false);
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
