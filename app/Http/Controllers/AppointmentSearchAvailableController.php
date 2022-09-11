<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\Specialist;
use App\Models\AppointmentTimeRequirement;
use App\Models\Clinic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AppointmentSearchAvailableController extends Controller
{

    /**
     * [Appointment] - Search Available
     *
     * @group Appointments
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @urlParam clinic_id           A Clinic id.                                Example: 1
     * @urlParam x_weeks             Number of weeks on the future to search.    Example: 2
     * @urlParam specialist_id       A Specialist user Id.                            Example: 16
     * @urlParam appointment_type_id An Appointment Type id.                     Example: 3
     * @urlParam time_requirement    A Time Requirement Id.                      Example: 4
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        // Appointment Type
        $appointmentType = AppointmentType::find($request->appointment_type_id)->first();

        //Clinic Id
        $clinicId = $request->clinic_id;
        Log::info($clinicId );

        // Search date date
        $searchDate =  Carbon::create('monday this week')->addWeeks($request->x_weeks);

        // Time Frame To Search
        $timeframeParameters = $this->getTimeFrameParameter($request->time_requirement);
        $timeslotLength = $timeframeParameters['timeslotLength'];
        $startTime = $timeframeParameters['startTime'];
        $endTime = $timeframeParameters['endTime'];
       


        // Return a week long list of available appointment slots within the given parameters
        $days = ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'];
        $availableStartTimes = [];
        foreach ($days as $day) {
            $availableTimeslots = [];

            // Get All specialist working on given day
            $specialists = User::where('organization_id', auth()->user()->organization_id)
                ->where('role_id', UserRole::SPECIALIST) 
                ->whereHas('hrmUserBaseSchedules', function ($query) use ($day, $clinicId ) {
                    $query->where('week_day', $day);
                    if($clinicId != ""){
                        $query->where('clinic_id', $clinicId );
                    }
                })->get();


            $timeslotFilled = false;
            for ($time = $startTime; $time < $endTime; $time += $timeslotLength * 60) {
                foreach ($specialists as $specialist) {
                    
                    // Check each specialist available in timeslot and that that they can undergo that appointment type
                    if ($specialist->canWorkAt($time, $day) && $specialist->canAppointmentTypeAt($time, $day, $appointmentType)) {   
                        // Check if specialist already has an appointment in timeslot
                        if(!$specialist->hasAppointmentAtTime($time, $searchDate)){
                            $hrmUserBaseSchedule = $specialist->hrmUserBaseScheduleAtTimeDay($time, $day);
                            array_push($availableTimeslots, [
                              'time' =>  date('H:i', $time),
                              'specialist_name' => $specialist->full_name,
                              'specialist_id' => $specialist->id,
                              'clinic_id' => $hrmUserBaseSchedule->clinic_id,
                              'clinic_name' => Clinic::find($hrmUserBaseSchedule->clinic_id)->name,
                            ]);
                            $timeslotFilled = true;
                        } 
                        if($timeslotFilled){
                            $timeslotFilled = false;
                            break;
                        }
                       
                    }
                    
                }
          
            }

            array_push($availableStartTimes, [
                'day' => $day,
                'date' => $searchDate->format('d/m/Y'),
                'available_timeslots' => $availableTimeslots
            ]);

            $searchDate = $searchDate->addDay();
        }


        return response()->json(
            [
                'message' => 'METHOD NOT IMPLEMENTED',
                'data' => $availableStartTimes
            ],
            Response::HTTP_OK
        );
    }

    private function getTimeFrameParameter($time_requirement)
    {

        $organization = auth()->user()->organization;
        $timeslotLength = $organization->appointment_length;
        $startTime = Carbon::create($organization->start_time)->timestamp;
        $endTime = Carbon::create($organization->end_time)->timestamp;
        if ($time_requirement) {
            $timeRequirement = AppointmentTimeRequirement::find($time_requirement);
            $baseTime = Carbon::create($timeRequirement->base_time)->timestamp;
            if ($timeRequirement->type == 'After') {
                if ($startTime < $baseTime) {
                    $startTime = $baseTime;
                }
            } else if ($timeRequirement->type == 'Before') {
                if ($endTime > $baseTime) {
                    $endTime = $baseTime;
                }
            }
        }
        return [
            'timeslotLength' => $timeslotLength,
            'startTime'      => $startTime,
            'endTime'        => $endTime
        ];
    }
}
