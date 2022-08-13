<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\Specialist;
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
        $organization_id = auth()->user()->organization_id;
        $user_table = (new User())->getTable();
        $employee_table = (new Employee())->getTable();

        $employees = Employee::leftJoin(
            $user_table,
            'user_id',
            '=',
            $user_table . '.id'
        )
            ->select('*', "{$employee_table}.id")
            ->where('organization_id', $organization_id)
            ->with('specialist')
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
     * Return a listing of anesthetists.
     *
     * @return \Illuminate\Http\Response
     */
    public function anesthetists()
    {
        $anesthetists = Employee::anesthetists()->get();

        return response()->json(
            [
                'message' => 'Anesthetist List',
                'data' => $anesthetists,
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
        $role = UserRole::find($request->role_id);

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
            ...$request->all(),
            'password' => Hash::make($request->password),
            'organization_id' => $organization_id,
        ]);

        $employee = Employee::create([
            'user_id' => $user->id,
            'type' => $request->type,
            'work_hours' => json_encode($request->work_hours),
        ]);

        if ($role->slug == 'specialist') {
            Specialist::create([
                'employee_id' => $employee->id,
                'specialist_title_id' => $request->specialist_title_id,
                'specialist_type_id' => $request->specialist_type_id,
                'anesthetist_id' => $request->anesthetist_id,
            ]);
        }

        if ($file = $request->file('header')) {
            $file_name =
                'header_' .
                $employee->id .
                '_' .
                time() .
                '.' .
                $file->extension();
            $header_path = '/' . $file->storeAs('images/employee', $file_name);
            $employee->document_letter_header = $header_path;
        }

        if ($file = $request->file('footer')) {
            $file_name =
                'footer_' .
                $employee->id .
                '_' .
                time() .
                '.' .
                $file->extension();
            $footer_path = '/' . $file->storeAs('images/employee', $file_name);
            $employee->document_letter_footer = $footer_path;
        }

        if ($file = $request->file('signature')) {
            $file_name =
                'signature_' .
                $employee->id .
                '_' .
                time() .
                '.' .
                $file->extension();
            $signature_path =
                '/' . $file->storeAs('images/employee', $file_name);
            $employee->signature = $signature_path;
        }

        $employee->save();

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
        $role = UserRole::find($request->role_id);

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
            ...$request->all(),
            'organization_id' => $organization_id,
        ]);

        $employee->update([
            'type' => $request->type,
            'work_hours' => $request->work_hours,
        ]);

        if ($role->slug == 'specialist') {
            $specialist = $employee->specialist;

            if (empty($specialist)) {
                $specialist = Specialist::create([
                    'employee_id' => $employee->id,
                    'specialist_title_id' => $request->specialist_title_id,
                    'specialist_type_id' => $request->specialist_type_id,
                    'anesthetist_id' => $request->anesthetist_id,
                ]);
            } else {
                $specialist->update([
                    'employee_id' => $employee->id,
                    'specialist_title_id' => $request->specialist_title_id,
                    'specialist_type_id' => $request->specialist_type_id,
                    'anesthetist_id' => $request->anesthetist_id,
                ]);
            }
        }

        if ($file = $request->file('header')) {
            $file_name =
                'header_' .
                $employee->id .
                '_' .
                time() .
                '.' .
                $file->extension();
            $header_path = '/' . $file->storeAs('images/employee', $file_name);
            $employee->document_letter_header = $header_path;
        }

        if ($file = $request->file('footer')) {
            $file_name =
                'footer_' .
                $employee->id .
                '_' .
                time() .
                '.' .
                $file->extension();
            $footer_path = '/' . $file->storeAs('images/employee', $file_name);
            $employee->document_letter_footer = $footer_path;
        }

        if ($file = $request->file('signature')) {
            $file_name =
                'signature_' .
                $employee->id .
                '_' .
                time() .
                '.' .
                $file->extension();
            $signature_path =
                '/' . $file->storeAs('images/employee', $file_name);
            $employee->signature = $signature_path;
        }

        $employee->save();

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
