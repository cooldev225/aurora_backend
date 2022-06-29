<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Specialist;
use App\Models\SpecialistType;
use App\Models\SpecialistTitle;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Employee;
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
        $specialist_title_table = (new SpecialistTitle())->getTable();
        $specialist_table = (new Specialist())->getTable();

        $specialist_list = Specialist::organizationSpecialists();

        if ($request->has('specialist_id')) {
            $specialist_list = $specialist_list->whereIn(
                $specialist_table . '.id',
                $request->specialist_id
            );
        }

        $day_of_week_list = [];

        if ($request->has('date') || $request->has('day')) {
            if ($request->has('day')) {
                $day_of_week_list = $request->input('day');
            }

            if ($request->has('date')) {
                $day_of_week = getdate(strtotime($request->input('date')))[
                    'weekday'
                ];

                $day_of_week = strtolower($day_of_week);

                $day_of_week_list[] = $day_of_week;
            }

            foreach ($day_of_week_list as $day_of_week) {
                $specialist_list = $specialist_list->orWhereJsonContains(
                    'work_hours',
                    [$day_of_week => ['available' => true]]
                );
            }
        }

        $specialists = $specialist_list
            ->select(
                $specialist_table . '.id',
                $specialist_title_table . '.name',
                'work_hours'
            )
            ->limit(10)
            ->get()
            ->toArray();

        foreach ($specialists as $key => $specialist) {
            $temp = (array) json_decode($specialist['work_hours']);
            $specialists[$key]['work_hours'] = [];

            foreach ($day_of_week_list as $day_of_week) {
                $specialists[$key]['work_hours'][$day_of_week] =
                    $temp[$day_of_week];
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
