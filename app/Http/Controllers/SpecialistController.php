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
        $organization_id = auth()->user()->organization_id;

        $employee_table = (new Employee())->getTable();
        $user_table = (new User())->getTable();
        $specialist_title_table = (new SpecialistTitle())->getTable();
        $specialist_type_table = (new SpecialistType())->getTable();

        $specialist_list = Specialist::leftJoin(
            $employee_table,
            'employee_id',
            '=',
            $employee_table . '.id'
        )
            ->leftJoin($user_table, 'user_id', '=', $user_table . '.id')
            ->leftJoin(
                $specialist_title_table,
                'specialist_title_id',
                '=',
                $specialist_title_table . '.id'
            )
            ->leftJoin(
                $specialist_type_table,
                'specialist_type_id',
                '=',
                $specialist_type_table . '.id'
            )
            ->where('organization_id', $organization_id);

        if ($request->has('date') || $request->has('day')) {
            $day_of_week_list = [];

            if ($request->has('day')) {
                $day_of_week_list = $request->input('day');
            }

            if ($request->has('date')) {
                $day_of_week_list[] = getdate(
                    strtotime($request->input('date'))
                )['weekday'];
            }

            foreach ($day_of_week_list as $day_of_week) {
                $specialist_list = $specialist_list->orWhereJsonContains(
                    'work_hours',
                    [$day_of_week => ['available' => true]]
                );
            }
        }

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
