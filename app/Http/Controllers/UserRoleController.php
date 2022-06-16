<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRoleRequest;
use App\Http\Requests\UpdateUserRoleRequest;
use Illuminate\Contracts\Support\Jsonable;
use App\Models\UserRole;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = UserRole::paginate()->toJson();
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRoleRequest $request)
    {
        $user_role = UserRole::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return response()->json(
            [
                'message' => 'User Role successfully registered',
                'user_role' => $user_role,
                'status' => 'ok',
            ],
            201
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRoleRequest  $request
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRoleRequest $request, UserRole $userRole)
    {
        $userRole->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return response()->json([
            'message' => 'User Role successfully updated',
            'user_role' => $user_role,
            'status' => 'ok',
        ]);
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

        return response()->json([
            'message' => 'User Role successfully Removed',
            'status' => 'ok',
        ]);
    }
}