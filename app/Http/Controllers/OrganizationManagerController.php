<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Requests\UserRequest;
use App\Http\Requests\AdminRequest;

class OrganizationManagerController extends Controller
{
    /**
     * Instantiate a new OrganizationManagerController instance.
     */
    public function __construct()
    {
        $this->organization_manager_role = UserRole::where(
            'slug',
            'organizationManager'
        )->first();
    }

    /**
     * [Organization Manager] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAll', User::class);

        $organization_id = auth()->user()->organization_id;

        $organization_managers = User::where(
            'organization_id',
            $organization_id
        )
            ->where('role_id', $this->organization_manager_role->id)
            ->get();

        return response()->json(
            [
                'message' => 'Organization Manager List',
                'data' => $organization_managers,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Organization Manager] - Store
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('store', User::class);

        $organization_id = auth()->user()->organization_id;

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => $this->organization_manager_role->id,
            'organization_id' => $organization_id,
            'password' => Hash::make($request->password),
            'raw_password' => $request->password,
        ]);

        return response()->json(
            [
                'message' => 'Organization Manager created',
                'data' => $user,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Organization Manager] - Update
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
            'role_id' => $this->organization_manager_role->id,
            'organization_id' => $organization_id,
        ]);

        return response()->json(
            [
                'message' => 'Organization Manager updated',
                'data' => $user,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Organization Manager] - Destroy
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
                'message' => 'Organization Manager Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
