<?php

namespace Database\Seeders;

use App\Enum\UserRole;
use App\Models\Clinic;
use App\Models\HrmFilledWeek;
use App\Models\HrmScheduleTimeslot;
use App\Models\HrmWeeklySchedule;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class HrmWeeklyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        $period = CarbonPeriod::create(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
        $startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
        $endDate = Carbon::now()->endOfWeek()->format('Y-m-d');
        $hrmFilledWeek = HrmFilledWeek::create([
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
        foreach ($period as $day) {
            $timeSlots = HrmScheduleTimeslot::where('week_day', strtoupper($day->format('D')))->get();
            foreach ($timeSlots as $slot) {
                $slot->hrmWeeklySchedule()->create([
                    'organization_id' => $slot->organization_id,
                    'hrm_filled_week_id' => $hrmFilledWeek->id,
                    'date' => $day->toDateString(),
                    'clinic_id' => $slot->clinic_id,
                    'week_day' => $slot->week_day,
                    'category' => $slot->category,
                    'user_id' => $slot->user_id,
                    'anesthetist_id' => $slot->anesthetist_id,
                    'start_time' => $slot->start_time,
                    'end_time' => $slot->end_time,
                    'status' => 'UNPUBLISHED',
                    'is_template' => true,
                ]);
            }
        }
    }
}
