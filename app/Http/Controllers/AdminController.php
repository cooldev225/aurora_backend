<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{
    /**
     * [Admin User] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', User::class);

        $result = User::where('role_id', UserRole::ADMIN)->get();

        return response()->json(
            [
                'message' => 'Admin List',
                'data' => $result,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Admin User] - Store
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', User::class);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
            'raw_password' => $request->password,
            'role_id' => $this->admin_role->id,
        ]);

        return response()->json(
            [
                'message' => 'Admin created',
                'data' => $user,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Admin User] - Update
     *
     * @param  \App\Http\Requests\AdminRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, User $user)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $user);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => $this->admin_role->id,
        ]);

        return response()->json(
            [
                'message' => 'Admin updated',
                'data' => $user,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Admin User] - Destroy
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
                'message' => 'Admin Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
