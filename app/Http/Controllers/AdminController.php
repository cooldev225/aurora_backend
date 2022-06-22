<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Requests\UserRequest;
use App\Http\Requests\AdminRequest;

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
        $result = User::where('role_id', $this->admin_role->id)->get();

        return response()->json(
            [
                'message' => 'Admin List',
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
                'message' => 'Admin created',
                'data' => $user,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AdminRequest  $request
     * @param  $user_id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $user_id)
    {
        $user = User::find($user_id);
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
     * Remove the specified resource from storage.
     *
     * @param  $user_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $user = User::find($user_id);
        $user->delete();

        return response()->json(
            [
                'message' => 'Admin Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
