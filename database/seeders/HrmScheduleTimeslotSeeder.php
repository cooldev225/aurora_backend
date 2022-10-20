<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\HrmScheduleTimeslot;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class HrmScheduleTimeslotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        $users = User::where('organization_id', 1)->get();
        $days = ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'];
        foreach ($users as $user) {
            foreach ($days as $day) {
                $clinic_id = Clinic::where('organization_id', 1)->inRandomOrder()->first()->id;
                if (rand(0, 1)) {
                    HrmScheduleTimeslot::create([
                        'organization_id'   => 1,
                        'clinic_id'         => $clinic_id,
                        'week_day'          => $day,
                        'category'          => 'WORKING',
                        'user_id'           => $user->id,
                        'start_time'        => $this->faker->randomElement(['07:00:00', '08:30:00', '06:30:00']),
                        'end_time'          => $this->faker->randomElement(['14:00:00', '14:30:00', '12:30:00']),
                        'restriction'       => $this->faker->randomElement(['NONE', 'PROCEDURE', 'CONSULTATION']),
                        'is_template'       => true,

                    ]);
                    HrmScheduleTimeslot::create([
                        'organization_id'   => 1,
                        'clinic_id'         => $clinic_id,
                        'week_day'          => $day,
                        'category'          => 'WORKING',
                        'user_id'           => $user->id,
                        'start_time'        => $this->faker->randomElement(['14:30:00', '15:00:00', '15:30:00']),
                        'end_time'          => $this->faker->randomElement(['19:00:00', '20:30:00', '18:30:00']),
                        'restriction'       => $this->faker->randomElement(['NONE', 'PROCEDURE', 'CONSULTATION']),
                        'is_template'       => true,

                    ]);
                }
            }
        }
    }
}
