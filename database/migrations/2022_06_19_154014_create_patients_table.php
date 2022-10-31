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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table
                ->enum('gender', [1, 2, 3, 9])
                ->default(9);
            $table->date('date_of_birth');
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('suburb')->nullable();
            $table
                ->enum('marital_status', [1, 2, 3, 4, 5, 6, 7, 9])
                ->default(9);
            $table->string('birth_place_code')->nullable();
            $table
                ->enum('country_of_birth', [
                    '0000',
                    '0001',
                    '0002',
                    '0003',
                    '1000',
                    '1100',
                    '1101',
                    '1102',
                    '1199',
                    '1201',
                    '1300',
                    '1301',
                    '1302',
                    '1303',
                    '1304',
                    '1400',
                    '1401',
                    '1402',
                    '1403',
                    '1404',
                    '1405',
                    '1406',
                    '1407',
                    '1500',
                    '1501',
                    '1502',
                    '1503',
                    '1504',
                    '1505',
                    '1506',
                    '1507',
                    '1508',
                    '1511',
                    '1512',
                    '1513',
                    '1599',
                    '1600',
                    '1601',
                    '1602',
                    '1603',
                    '1604',
                    '1605',
                    '1606',
                    '1607',
                    '2000',
                    '2100',
                    '2102',
                    '2103',
                    '2104',
                    '2105',
                    '2106',
                    '2107',
                    '2108',
                    '2201',
                    '2300',
                    '2301',
                    '2302',
                    '2303',
                    '2304',
                    '2305',
                    '2306',
                    '2307',
                    '2308',
                    '2311',
                    '2400',
                    '2401',
                    '2402',
                    '2403',
                    '2404',
                    '2405',
                    '2406',
                    '2407',
                    '2408',
                    '3000',
                    '3100',
                    '3101',
                    '3102',
                    '3103',
                    '3104',
                    '3105',
                    '3106',
                    '3107',
                    '3108',
                    '3200',
                    '3201',
                    '3202',
                    '3203',
                    '3204',
                    '3205',
                    '3206',
                    '3207',
                    '3208',
                    '3211',
                    '3212',
                    '3214',
                    '3215',
                    '3216',
                    '3300',
                    '3301',
                    '3302',
                    '3303',
                    '3304',
                    '3305',
                    '3306',
                    '3307',
                    '3308',
                    '3311',
                    '3312',
                    '4000',
                    '4100',
                    '4101',
                    '4102',
                    '4103',
                    '4104',
                    '4105',
                    '4106',
                    '4107',
                    '4108',
                    '4111',
                    '4200',
                    '4201',
                    '4202',
                    '4203',
                    '4204',
                    '4205',
                    '4206',
                    '4207',
                    '4208',
                    '4211',
                    '4212',
                    '4213',
                    '4214',
                    '4215',
                    '4216',
                    '4217',
                    '5000',
                    '5100',
                    '5101',
                    '5102',
                    '5103',
                    '5104',
                    '5105',
                    '5200',
                    '5201',
                    '5202',
                    '5203',
                    '5204',
                    '5205',
                    '5206',
                    '6000',
                    '6100',
                    '6101',
                    '6102',
                    '6103',
                    '6104',
                    '6105',
                    '6200',
                    '6201',
                    '6202',
                    '6203',
                    '7000',
                    '7100',
                    '7101',
                    '7102',
                    '7103',
                    '7104',
                    '7105',
                    '7106',
                    '7107',
                    '7200',
                    '7201',
                    '7202',
                    '7203',
                    '7204',
                    '7205',
                    '7206',
                    '7207',
                    '7208',
                    '7211',
                    '8000',
                    '8100',
                    '8101',
                    '8102',
                    '8103',
                    '8104',
                    '8200',
                    '8201',
                    '8202',
                    '8203',
                    '8204',
                    '8205',
                    '8206',
                    '8207',
                    '8208',
                    '8211',
                    '8212',
                    '8213',
                    '8214',
                    '8215',
                    '8216',
                    '8299',
                    '8300',
                    '8301',
                    '8302',
                    '8303',
                    '8304',
                    '8305',
                    '8306',
                    '8307',
                    '8308',
                    '8400',
                    '8401',
                    '8402',
                    '8403',
                    '8404',
                    '8405',
                    '8406',
                    '8407',
                    '8408',
                    '8411',
                    '8412',
                    '8413',
                    '8414',
                    '8415',
                    '8416',
                    '8417',
                    '8421',
                    '8422',
                    '8423',
                    '8424',
                    '8425',
                    '8426',
                    '8427',
                    '8428',
                    '8431',
                    '8432',
                    '8433',
                    '8434',
                    '8435',
                    '9000',
                    '9100',
                    '9101',
                    '9102',
                    '9103',
                    '9104',
                    '9105',
                    '9106',
                    '9107',
                    '9108',
                    '9111',
                    '9112',
                    '9113',
                    '9114',
                    '9115',
                    '9116',
                    '9117',
                    '9118',
                    '9121',
                    '9122',
                    '9123',
                    '9124',
                    '9125',
                    '9126',
                    '9127',
                    '9128',
                    '9200',
                    '9201',
                    '9202',
                    '9203',
                    '9204',
                    '9205',
                    '9206',
                    '9207',
                    '9208',
                    '9211',
                    '9212',
                    '9213',
                    '9214',
                    '9215',
                    '9216',
                    '9217',
                    '9218',
                    '9221',
                    '9222',
                    '9223',
                    '9224',
                    '9225',
                    '9226',
                    '9227',
                    '9228',
                    '9231',
                    '9232',
                    '9299',
                ])
                ->default('0000');
            $table->string('birth_state')->nullable();
            $table->enum('race', [1, 2, 3, 4, 9])
            ->default(9);
            $table->string('occupation')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->enum('preferred_contact_method', ['sms','email',])->default('sms');
            $table->enum('appointment_confirm_method', ['sms','email',])->default('sms');
            $table->enum('send_recall_method', ['sms', 'email', 'mail'])->default('sms');
            $table->string('kin_name')->nullable();
            $table->string('kin_relationship')->nullable();
            $table->string('kin_phone_number')->nullable();
            $table->string('kin_email')->nullable();
            $table->text('clinical_alerts')->nullable();
            $table->boolean('kin_receive_correspondence')->default(false);
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
        Schema::dropIfExists('patients');
    }
};
