<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Specialist;
use App\Models\UserRole;
use App\Models\Employee;
use App\Models\AppointmentTimeRequirement;
use App\Http\Requests\SpecialistRequest;
use App\Models\User;

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
     * [Specialist] - List
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
     * [Specialist] - Work Hours By Week
     *
     * @return \Illuminate\Http\Response
     */
    public function workHoursByWeek(Request $request)
    {
        $date = date('Y-m-d');

        if ($request->has('date')) {
            $date = date('Y-m-d', strtotime($request->date));
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
     * [Specialist] - Store
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
     * [Specialist] - Update
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
     * [Specialist] - Destroy
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
