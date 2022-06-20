<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Requests\UserRequest;

class AdminController extends Controller
{
    /**
     * Instantiate a new AdminController instance.
     */
    public function __construct()
    {
        $this->admin_role = UserRole::where('slug', 'admin')
            ->limit(1)
            ->get()[0];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = User::where('role_id', $this->admin_role->id)
            ->get()
            ->toArray();

        return response()->json(
            [
                'message' => 'Admin Role List',
                'data' => $result,
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
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
            'role_id' => $this->admin_role->id,
        ]);

        return response()->json(
            [
                'message' => 'Admin successfully created',
                'data' => $user,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
            'role_id' => $this->admin_role->id,
        ]);

        return response()->json(
            [
                'message' => 'Admin successfully updated',
                'data' => $user,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(
            [
                'message' => 'Admin Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
