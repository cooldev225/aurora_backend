<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_table = (new User())->getTable();

        $employees = Employee::leftJoin(
            $user_table,
            'user_id',
            '=',
            $user_table . '.id'
        )
            ->where('organization_id', auth()->user()->organization_id)
            ->get();

        return response()->json(
            [
                'message' => 'Employee List',
                'data' => $employees,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $organization_id = auth()->user()->organization_id;
        $role = UserRole::where('slug', $request->role)->first();

        if (!$role->isEmployee()) {
            return response()->json(
                [
                    'message' =>
                        'Unable to create a user without employee role',
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'organization_id' => $organization_id,
        ]);

        $employee = Employee::create([
            'user_id' => $user->id,
            'clinic_id' => auth()
                ->user()
                ->currentClinic()->id,
            'type' => $request->type,
        ]);

        return response()->json(
            [
                'message' => 'New Employee created',
                'data' => $employee,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $organization_id = auth()->user()->organization_id;
        $role = UserRole::where('slug', $request->role)->first();

        if (!$role->isEmployee()) {
            return response()->json(
                [
                    'message' =>
                        'Unable to create a user without employee role',
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $user = $employee->user();
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => $role->id,
            'organization_id' => $organization_id,
        ]);

        $employee->update([
            'clinic_id' => auth()
                ->user()
                ->currentClinic()->id,
            'type' => $request->type,
        ]);

        return response()->json(
            [
                'message' => 'Employee updated',
                'data' => $employee,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $user = $employee->user();
        $user->delete();
        $employee->delete();

        return response()->json(
            [
                'message' => 'Employee Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
