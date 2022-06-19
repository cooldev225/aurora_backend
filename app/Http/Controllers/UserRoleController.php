<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRoleRequest;
use App\Models\UserRole;
use Illuminate\Http\Response;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = UserRole::all()->toArray();

        return response()->json(
            [
                'message' => 'User Role List',
                'data' => $result,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
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
                'message' => 'User Role successfully created',
                'data' => $user_role,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
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
                'message' => 'User Role successfully updated',
                'data' => $userRole,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRole $userRole)
    {
        $userRole->delete();

        return response()->json(
            [
                'message' => 'User Role successfully Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
