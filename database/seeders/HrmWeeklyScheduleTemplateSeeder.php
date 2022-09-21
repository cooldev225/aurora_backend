<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\HrmScheduleTimeslots;
use App\Models\HrmWeeklyScheduleTemplate;
use Illuminate\Database\Seeder;
use Faker\Factory;

class HrmWeeklyScheduleTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $clinics = Clinic::all();


        foreach ($clinics as $clinic) {

            for ($i = 0; $i < 10; $i++) {

                HrmWeeklyScheduleTemplate::create([
                    'clinic_id' =>  $clinic->id,
                    'role_id'   =>  $faker->randomElement([2, 3, 5, 9])
                ]);
            }
            
            $scheduleTemplates =  $clinic->scheduleTemplates;
            foreach ($scheduleTemplates as $scheduleTemplate) {
                $weekdays = ['MON', 'TUS', 'WED', 'THU', 'FRI', 'SAT', 'SUN'];
                foreach ($weekdays as $weekday) {
                    $workingOnDay = rand(0, 2);
                    if ($workingOnDay == 1) {
                        HrmScheduleTimeslots::create([
                            'hrm_weekly_schedule_template_id' => $scheduleTemplate->id,
                            'week_day' => $weekday,
                            'start_time' => '08:00',
                            'end_time' => '012:00',
                        ]);

                        HrmScheduleTimeslots::create([
                            'hrm_weekly_schedule_template_id' => $scheduleTemplate->id,
                            'week_day' => $weekday,
                            'start_time' => '12:00',
                            'end_time' => '16:00',
                        ]);
                    }
                }
            }
        }
    }
}
