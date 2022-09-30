<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmWeeklyScheduleTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['clinic_id','type','role_id','user_id'];

    /**
     * Returns user
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Returns user
     */
    public function clinic()
    {
        return $this->hasOne(Clinic::class);
    }

        /**
     * Returns timeslots
     */
    public function timeslots()
    {
        return $this->hasMany(HrmScheduleTimeslots::class);
    }

    public function update(array $attributes = [], array $options = [])
    {
        parent::update($attributes, $options);
        $arrID = [];
        if(array_key_exists('timeslots', $attributes)){
            foreach ($attributes['timeslots'] as $timeslot) {
                $timeslot = (object) $timeslot;
                $timeslotObj = null;
                if (isset($timeslot->id) && $timeslot->id!=null) {
                    $timeslotObj = HrmScheduleTimeslots::find($timeslot->id);
                }
                if ($timeslotObj == null) {
                    $timeslotObj = new HrmScheduleTimeslots();
                    $timeslotObj->hrm_weekly_schedule_template_id = $timeslot->hrm_weekly_schedule_template_id;
                }
                $timeslotObj->category = $timeslot->category;
                $timeslotObj->restriction = $timeslot->restriction;
                $timeslotObj->week_day = $timeslot->week_day;
                $timeslotObj->start_time = $timeslot->start_time;
                $timeslotObj->end_time = $timeslot->end_time;
                $timeslotObj->save();
                $arrID[] = $timeslotObj->id;
            }
        }
        HrmScheduleTimeslots::where('hrm_weekly_schedule_template_id', $this->id)
            ->whereNotIn('id', $arrID)
            ->delete();

        return HrmWeeklyScheduleTemplate::where('id', $this->id)
            ->with('timeslots')
            ->first();
    }
}
