<?php

namespace Database\Seeders;

use App\Models\ScheduleFee;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ScheduleFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ScheduleFee::factory(12)->create();

        // $arrFundId = HealthFund::pluck('id')->toArray();
        // $fee_count = 5;
        // $arrStrId = [];

        // for ($i = 0; $i < $fee_count; $i++) { 
        //     $rand_count = rand(1, 5);
        //     $arrIdKey = array_rand($arrFundId, $rand_count);
        //     $arrId = [];

        //     if ($rand_count == 1) {
        //         $arrIdKey = [$arrIdKey];
        //     }

        //     foreach ($arrIdKey as $key) {
        //         $arrId[] = $arrFundId[$key];
        //     }
        //     $str_id = implode('_', $arrId);
        //     if (in_array($str_id, $arrStrId) == false) {
        //         $arrStrId[] = $str_id;
        //     }
        // }

        // $faker = Factory::create();
        // $arrScheduleFees = ScheduleFee::all();
        // foreach ($arrScheduleFees as $schedule_fee) {
        //     foreach ($arrStrId as $str_id) {
        //         HealthFundFee::create([
        //             'fee_id'         => $schedule_fee->id,
        //             'fund_id'        => $str_id,
        //             'specialist_fee' => $faker->randomFloat(2, 100, 900),
        //             'hospital_fee'   => $faker->randomFloat(2, 100, 900),
        //             'start_date'     => $faker->dateTimeBetween('-1 year'),
        //             'end_date'       => $faker->dateTimeBetween('now', '+1 year')
        //         ]);
        //     }
        // }
    }
}
