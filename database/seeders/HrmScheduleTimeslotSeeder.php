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
        $users = User::all();
        $days = ['MON','TUS','WED','THU','FRI','SAT','SUN'];
        foreach ($users as $user) {
            foreach($days as $day){
                $clinic_id = Clinic::where('organization_id', 1)->inRandomOrder()->first()->id;
                if (rand(0, 5) > 2) {
                    HrmScheduleTimeslot::create([
                        'organization_id' => 1,
                        'clinic_id' => $clinic_id,
                        'week_day'  => $day,
                        'category'  => 'WORKING',
                        'user_id'   => $user->id,
                        'start_time'=> $this->faker->randomElement(['08:00:00', '09:30:00', '10:30:00']),
                        'end_time' => $this->faker->randomElement(['12:00:00', '13:00:00', '12:30:00']),
                        'is_template' =>true,

                    ]);
                }

                if (rand(0, 5) > 2) {
                    HrmScheduleTimeslot::create([
                        'organization_id' => 1,
                        'clinic_id' => $clinic_id,
                        'week_day'  => $day,
                        'category'  => 'WORKING',
                        'user_id'   => $user->id,
                        'start_time'=> $this->faker->randomElement(['13:00:00', '13:30:00', '14:30:00']),
                        'end_time' => $this->faker->randomElement(['16:00:00', '18:30:00', '20:30:00']),
                        'is_template' =>true,

                    ]);
                }

            }
        }
    }
}
