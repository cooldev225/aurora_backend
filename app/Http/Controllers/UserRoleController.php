<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\UserRoleRequest;
use App\Models\UserRole;

class UserRoleController extends Controller
{
    /**
     * [User's Role] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = UserRole::all();

        return response()->json(
            [
                'message' => 'User Role List',
                'data' => $roles,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [User's Role] - Employee Role List
     *
     * @return \Illuminate\Http\Response
     */
    public function employeeRoles()
    {
        $roles = UserRole::employeeRoles()->get();

        return response()->json(
            [
                'message' => 'Employee Role List',
                'data' => $roles,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [User's Role] - Store
     *
     * @param  \App\Http\Requests\UserRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRoleRequest $request)
    {
        $user_role = UserRole::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'hrm_type' => $request->hrm_type,
        ]);

        return response()->json(
            [
                'message' => 'User Role created',
                'data' => $user_role,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [User's Role] - Update
     *
     * @param  \App\Http\Requests\UserRoleRequest  $request
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function update(UserRoleRequest $request, UserRole $userRole)
    {
        $userRole->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'hrm_type' => $request->hrm_type,
        ]);

        return response()->json(
            [
                'message' => 'User Role updated',
                'data' => $userRole,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [User's Role] - Destroy
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRole $userRole)
    {
        $userRole->delete();

        return response()->json(
            [
                'message' => 'User Role Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
