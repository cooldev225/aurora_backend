<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Mail\NewEmployee;
use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Requests\AdminRequest;

class UserController extends Controller
{
    /**
     * [User] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', [User::class, auth()->user()->organization_id]);

        $organization = auth()->user()->organization;
        $users = User::where(
            'organization_id',
            $organization->id
        )
            ->with('hrmUserBaseSchedules')
            ->get();
        return response()->json(
            [
                'message' => 'Employee List',
                //'data' => $organization->users,
                'data' => $users,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Authentication] - User Login
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'string|min:2|max:100',
            'email' => 'email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $auth_params = $validator->validated();

        if (empty($auth_params['email'])) {
            $user = User::where('username', $auth_params['username'])->first();

            if (empty($user)) {
                return response()->json(
                    ['error' => 'Unauthorized'],
                    Response::HTTP_UNAUTHORIZED
                );
            } else {
                $auth_params['email'] = $user->email;
            }
        }

        if (!($token = auth()->attempt($validator->validated()))) {
            return response()->json(
                ['error' => 'Unauthorized'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $user = auth()->user();

        return response()->json(
            [
                'email' => $user->email,
                'username' => $user->username,
                'role' => $user->role->slug,
                'access_token' => $token,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Authentication] - Verify Token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify_token(Request $request)
    {
        $user = auth()->user();
        $token = auth()->fromUser($user);

        return response()->json(
            [
                'email' => $user->email,
                'username' => $user->username,
                'role' => $user->role->slug,
                'access_token' => $token,
                'profile' => auth()->user(),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Authentication] - User Logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out.']);
    }

    /**
     * [Authentication] - Refresh Token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * [User] - User Profile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(
            $this->withBaseUrlForSingleUser(auth()->user())
        );
    }

    /**
     * [User] - Update User Profile
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Verify the user can access this function via policy
        $this->authorize('updateProfile', $user);

        $user->update($request->all());

        if ($file = $request->file('photo')) {
            $file_name =
                'photo_' . $user->id . '_' . time() . '.' . $file->extension();
            $photo_path = '/' . $file->storeAs('images/user', $file_name);
            $user->photo = $photo_path;
            $user->save();
        }

        return response()->json(
            [
                'message' => 'User Profile updated',
                'data' => $user,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' =>
                auth()
                    ->factory()
                    ->getTTL() * 60,
        ]);
    }

    /**
     * [User] - Update Password
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|different:old_password',
            'confirm_password' => 'required|string|min:6|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors(),
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => [
                        'old_password' => 'Old password didn\'t match.',
                    ],
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $user = auth()->user();

        // Verify the user can access this function via policy
        $this->authorize('updateProfile', $user);

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Password changed successfully',
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Change avatar path to url
     */
    protected function withBaseUrl($user_list)
    {
        $base_url = url('/');

        $user_list = $user_list->toArray();

        foreach ($user_list as $key => $user) {
            if (substr($user['photo'], 0, 1) == '/') {
                $user_list[$key]['photo'] = $base_url . $user['photo'];
            }
        }

        return $user_list;
    }

    /**
     * Change avatar path to url
     */
    protected function withBaseUrlForSingleUser($user)
    {
        $base_url = url('/');

        $user = $user->toArray();

        if (substr($user['photo'], 0, 1) == '/') {
            $user['photo'] = $base_url . $user['photo'];
        }

        return $user;
    }

    
    /**
     * [Employee] - Destroy
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
                'message' => 'Employee Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }

       /**
     * [Employee] - Store
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', [User::class, auth()->user()->organization_id]);

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $username = auth()->user()->organization->code . $first_name[0] . $last_name;
        $i = 0;
            while(User::whereUsername($username)->exists())
            {
                $i++;
                $username = $first_name[0] . $last_name . $i;
            }

        $raw_password = Str::random(14);

        //Create New Employee
        $user = User::create([
            'organization_id' => auth()->user()->organization_id,
            'username' => $username,
            'password' => Hash::make($raw_password),
            ...$request->validated()
        ]);

        $this->update($request, $user);

        //Send An email to the user with their credentials and al link
        Mail::to($user->email)->send(new NewEmployee($user, $raw_password));

        return response()->json(
            [
                'message' => 'User Created',
                'data' => User::find($user->id)
            ],
            Response::HTTP_OK
        );
    }

        /**
     * [Employee] - Update
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $user);
        $organization_id = auth()->user()->organization_id;

        $user = $user->update([
            ...$request->validated(),
            'organization_id' => $organization_id,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'type' => $request->type,
            'hrm_user_base_schedules' => $request->hrm_user_base_schedules,
        ]);
        return response()->json(
            [
                'message' => 'User updated',
                'data' => $user,
            ],
            Response::HTTP_OK
        );
    }
}
