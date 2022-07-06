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
     * Return available specialist and work hours by date
     */
    protected function workHoursByDate(Request $request, $date)
    {
        $specialist_table = (new Specialist())->getTable();
        $employee_table = (new Employee())->getTable();

        $specialist_list = Specialist::organizationSpecialists();

        if ($request->filled('specialists')) {
            $specialist_list = $specialist_list->whereIn(
                $specialist_table . '.id',
                $request->specialists
            );
        }

        $day_of_week = strtolower(date('l', strtotime($date)));

        $specialist_list->whereJsonContains($employee_table . '.work_hours', [
            $day_of_week => ['available' => true],
        ]);

        if ($request->has('clinic_id')) {
            $specialist_list->whereJsonContains('work_hours', [
                $day_of_week => ['location' => $request->clinic_id],
            ]);
        }

        $specialists = $specialist_list->get()->toArray();
        $specialist_ids = [];

        foreach ($specialists as $key => $specialist) {
            $temp = (array) json_decode($specialist['work_hours']);
            $specialist_ids[] = $specialist['id'];

            $specialists[$key]['work_hours'] = $temp[$day_of_week];

            $specialists[$key]['anesthetist'] = [
                'id' => $specialist['anesthetist_id'],
                'name' => $specialist['anesthetist_name'],
            ];

            unset($specialists[$key]['anesthetist_id']);
            unset($specialists[$key]['anesthetist_name']);
        }

        $appointments = Specialist::withAppointments()
            ->whereIn('specialist_id', $specialist_ids)
            ->where('date', $date);

        if ($request->has('appointment_type_id')) {
            $appointments->where(
                'appointment_type_id',
                $request->appointment_type_id
            );
        }

        $appointments = $appointments->get()->toArray();

        foreach ($specialists as $key => $specialist) {
            $specialists[$key]['appointments'] = [];

            foreach ($appointments as $appointment) {
                if ($appointment['specialist_id'] == $specialist['id']) {
                    $specialists[$key]['appointments'][] = $appointment;
                }
            }
        }

        return $specialists;
    }

    /**
     * Return available specialist and work hours
     *
     * @return \Illuminate\Http\Response
     */
    public function workHours(Request $request)
    {
        $date = date('Y-m-d');

        if ($request->has('date')) {
            $date = gmdate('Y-m-d', strtotime($request->date));
        }

        return response()->json(
            [
                'message' => 'Available Specialist List and work hours by day ',
                'data' => $this->workHoursByDate($request, $date),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Return available specialist and work hours For a week
     *
     * @return \Illuminate\Http\Response
     */
    public function workHoursByWeek(Request $request)
    {
        $date = date('Y-m-d');

        if ($request->has('date')) {
            $date = gmdate('Y-m-d', strtotime($request->date));
        }

        $search_dates = [];
        $appointment_date = date_create($date);

        for ($i = 0; $i < 7; $i++) {
            $search_dates[] = date_format($appointment_date, 'Y-m-d');
            date_add(
                $appointment_date,
                date_interval_create_from_date_string('1 day')
            );
        }

        $return = [];

        foreach ($search_dates as $search_date) {
            $return[$search_date] = $this->workHoursByDate($request, $date);
        }

        return response()->json(
            [
                'message' =>
                    'Available Specialist List and work hours by Week ',
                'data' => $return,
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
