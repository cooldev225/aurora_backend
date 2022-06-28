<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Requests\UserRequest;
use App\Http\Requests\AdminRequest;

class OrganizationAdminController extends Controller
{
    /**
     * Instantiate a new OrganizationAdminController instance.
     */
    public function __construct()
    {
        $this->organization_admin_role = UserRole::where(
            'slug',
            'organizationAdmin'
        )->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;
        $organization_admins = User::where('organization_id', $organization_id)
            ->where('role_id', $this->organization_admin_role->id)
            ->get();

        return response()->json(
            [
                'message' => 'Organization Admin List',
                'data' => $organization_admins,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => $this->organization_admin_role->id,
            'organization_id' => $organization_id,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(
            [
                'message' => 'Organization Admin created',
                'data' => $user,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  $user_id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $user_id)
    {
        $user = User::find($user_id);
        $organization_id = auth()->user()->organization_id;

        if ($user->organization_id != $organization_id) {
            return response()->json(
                [
                    'message' =>
                        'Could not update an admin in different Organization',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => $this->organization_admin_role->id,
            'organization_id' => $organization_id,
        ]);

        return response()->json(
            [
                'message' => 'Organization Admin updated',
                'data' => $user,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $user_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $user = User::find($user_id);
        $organization_id = auth()->user()->organization_id;

        if ($user->organization_id != $organization_id) {
            return response()->json(
                [
                    'message' =>
                        'Could not remove an admin in different Organization',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $user->delete();

        return response()->json(
            [
                'message' => 'Organization Admin Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
