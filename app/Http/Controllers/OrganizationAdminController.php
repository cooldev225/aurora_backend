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
     * [Organization Admin] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', User::class);

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
     * [Organization Admin] - Store
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', User::class);

        $organization_id = auth()->user()->organization_id;

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => $this->organization_admin_role->id,
            'organization_id' => $organization_id,
            'password' => Hash::make($request->password),
            'raw_password' => $request->password,
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
     * [Organization Admin] - Update
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, User $user)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $user);

        $organization_id = auth()->user()->organization_id;

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
     * [Organization Admin] - Destroy
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json(
            [
                'message' => 'Organization Admin Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
