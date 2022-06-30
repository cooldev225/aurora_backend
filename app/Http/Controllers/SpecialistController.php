<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Specialist;
use App\Models\SpecialistType;
use App\Models\SpecialistTitle;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Employee;
use App\Models\Appointment;
use App\Models\Patient;
use App\Http\Requests\SpecialistRequest;

class SpecialistController extends Controller
{
    /**
     * Instantiate a new AdminController instance.
     */
    public function __construct()
    {
        $this->specialist_role = UserRole::where('slug', 'specialist')->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $specialist_list = Specialist::organizationSpecialists();

        $specialists = $specialist_list->get();

        return response()->json(
            [
                'message' => 'Specialist List',
                'data' => $specialists,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Return available specialist and work hours
     *
     * @return \Illuminate\Http\Response
     */
    public function workHours(Request $request)
    {
        $specialist_table = (new Specialist())->getTable();
        $employee_table = (new Employee())->getTable();

        $specialist_list = Specialist::organizationSpecialists();

        $date = date('Y-m-d');

        if ($request->filled('specialists')) {
            $specialist_list = $specialist_list->whereIn(
                $specialist_table . '.id',
                $request->specialists
            );
        }

        $day_of_week_list = [];

        if ($request->has('date') || $request->has('day')) {
            if ($request->has('day')) {
                $day_of_week_list = $request->input('day');
            }

            if ($request->has('date')) {
                $date = $request->input('date');
                $day_of_week = getdate(strtotime($date))['weekday'];

                $day_of_week = strtolower($day_of_week);
                $day_of_week_list[] = $day_of_week;
            }

            $specialist_list = $specialist_list->where(function ($query) use (
                $day_of_week_list,
                $employee_table
            ) {
                foreach ($day_of_week_list as $day_of_week) {
                    $query->orWhereJsonContains(
                        $employee_table . '.work_hours',
                        [
                            $day_of_week => ['available' => true],
                        ]
                    );
                }
            });
        }

        if ($request->has('clinic_id')) {
            $specialist_list = $specialist_list->where(function ($query) use (
                $day_of_week_list
            ) {
                foreach ($day_of_week_list as $day_of_week) {
                    $query->orWhereJsonContains('work_hours', [
                        $day_of_week => ['location' => $request->clinic_id],
                    ]);
                }
            });
        }

        $specialists = $specialist_list
            ->limit(10)
            ->get()
            ->toArray();
        $specialist_ids = [];

        foreach ($specialists as $key => $specialist) {
            $temp = (array) json_decode($specialist['work_hours']);
            $specialist_ids[] = $specialist['id'];

            foreach ($day_of_week_list as $day_of_week) {
                $specialists[$key]['work_hours'] = $temp[$day_of_week];
            }
        }

        $appointments = Specialist::withAppointments()
            ->whereIn('specialist_id', $specialist_ids)
            ->where('date', $date)
            ->get()
            ->toArray();

        foreach ($specialists as $key => $specialist) {
            $specialists[$key]['appointments'] = [];

            foreach ($appointments as $appointment) {
                if ($appointment['specialist_id'] == $specialist['id']) {
                    $specialists[$key]['appointments'][] = $appointment;
                }
            }
        }

        return response()->json(
            [
                'message' => 'Available Specialist List and work hours by day ',
                'data' => $specialists,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SpecialistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialistRequest $request)
    {
        $specialist = Specialist::create([
            'employee_id' => $request->employee_id,
            'specialist_title_id' => $request->specialist_title_id,
            'specialist_type_id' => $request->specialist_type_id,
            'anesthetist_id' => $request->anesthetist_id,
        ]);

        return response()->json(
            [
                'message' => 'New Specialist created',
                'data' => $specialist,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SpecialistRequest  $request
     * @param  \App\Models\Specialist  $specialist
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialistRequest $request, Specialist $specialist)
    {
        $specialist->update([
            'employee_id' => $request->employee_id,
            'specialist_title_id' => $request->specialist_title_id,
            'specialist_type_id' => $request->specialist_type_id,
            'anesthetist_id' => $request->anesthetist_id,
        ]);

        return response()->json(
            [
                'message' => 'Specialist updated',
                'data' => $specialist,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialist  $specialist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialist $specialist)
    {
        $specialist->delete();

        return response()->json(
            [
                'message' => 'Specialist Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
