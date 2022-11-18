<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use App\Http\Requests\HrmEmployeeLeaveIndexRequest;
use App\Http\Requests\HrmEmployeeLeaveRequest;
use App\Models\Appointment;
use App\Models\HrmEmployeeLeave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class HrmEmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(HrmEmployeeLeaveIndexRequest $request)
    {
        $params = $request->validated();
        // Verify the user can access this function via policy
        $this->authorize('viewAny', [User::class, auth()->user()->organization_id]);

        $organization = auth()->user()->organization;
        $leaves = HrmEmployeeLeave::where(
            'organization_id',
            $organization->id
        );

        foreach ($params as $column => $param) {
            if ($column == 'date') {
                $startDate = Carbon::parse($param)->startOfWeek()->format('Y-m-d');
                $endDate = Carbon::parse($param)->endOfWeek()->format('Y-m-d');
                $leaves = $leaves->where('start_date', '>=', $startDate)->where('start_date', '<=', $endDate);
            } else {
                $leaves = $leaves->where($column, '=', $param);
            }
        }

        return response()->json(
            [
                'message' => 'Employee Leave List',
                'data' => $leaves->get(),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\HrmEmployeeLeaveRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(HrmEmployeeLeaveRequest $request)
    {
        $startDate = Carbon::parse($request->date[0])->toDateString();
        $endDate = Carbon::parse($request->date[1])->toDateString();
        $leave = HrmEmployeeLeave::create([
            "description" => $request->description,
            "organization_id" => auth()->user()->organization_id,
            "user_id" => auth()->user()->id,
            "status" => "Pending",
            "leave_type" => $request->leaveType,
            "start_date" => $startDate,
            "end_date" => $endDate,
            "full_day" => $request->isFullDay,
            "start_time" => $request->startTime,
            "end_time" => $request->endTime,
        ]);

        return \response()->json([
            'message' => 'Employee leave created successfully',
            'data' => $leave,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\HrmEmployeeLeaveRequest $request
     * @param \App\Models\HrmEmployeeLeave $hrmEmployeeLeave
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(HrmEmployeeLeaveRequest $request, HrmEmployeeLeave $hrmEmployeeLeave)
    {
        $startDate = Carbon::parse($request->date[0])->toDateString();
        $endDate = Carbon::parse($request->date[1])->toDateString();
        $hrmEmployeeLeave->update([
            "description" => $request->description,
            "status" => $request->status, // check permission
            "leave_type" => $request->leaveType,
            "start_date" => $startDate,
            "end_date" => $endDate,
            "full_day" => $request->isFullDay,
            "start_time" => $request->startTime,
            "end_time" => $request->endTime,
        ]);

        return \response()->json([
            'message' => 'Employee leave created successfully',
            'data' => $hrmEmployeeLeave,
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\HrmEmployeeLeave $hrmEmployeeLeave
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(HrmEmployeeLeave $hrmEmployeeLeave)
    {
        if ($hrmEmployeeLeave->status == "Pending" || auth()->user()->role_id == UserRole::ORGANIZATION_MANAGER) {
            $hrmEmployeeLeave->delete();
        }
        return \response()->json([
            'message' => 'Employee leave deleted successfully',
        ]);
    }
}
