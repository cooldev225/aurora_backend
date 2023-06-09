<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\AdminRequest;

class OrganizationAdminController extends Controller
{
    /**
     * [Organization Admin] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;
        // Verify the user can access this function via policy
        $this->authorize('viewAny', [User::class, $organization_id]);

        $organization_admins = User::where('organization_id', $organization_id)
            ->where('role_id', UserRole::ORGANIZATION_ADMIN)
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
     * @param  \App\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $organization_id = auth()->user()->organization_id;
        // Verify the user can access this function via policy
        $this->authorize('create', [User::class, $organization_id]);

        $user = User::create([
            ...$request->safe()->except(['password']),
            'role_id' => UserRole::ORGANIZATION_ADMIN,
            'organization_id' => $organization_id,
            'password' => Hash::make($request->password),
            'password_changed_date' => date('Y-m-d H:i:s'),
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
     * @param  \App\Http\Requests\AdminRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, User $user)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $user);

        $organization_id = auth()->user()->organization_id;

        $user->update([
            ...$request->safe()->except(['password']),
            'role_id' => UserRole::ORGANIZATION_ADMIN,
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
