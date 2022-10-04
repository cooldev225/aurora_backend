<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserIndexRequest;
use App\Http\Requests\UserRequest;
use App\Mail\NewEmployee;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * [User] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserIndexRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', [User::class, auth()->user()->organization_id]);

        $organization = auth()->user()->organization;
        $users = User::where(
            'organization_id',
            $organization->id
        )
        ->with('hrmUserBaseSchedules') //REMOVE
        ->with('scheduleTimeslots') //REPLACEMENT
        ->with('specialistClinicRelations');
            

        if($request->role_id){
            $users->where('role_id', $request->role_id);
        }

        return response()->json(
            [
                'message' => 'Employee List',
                'data' => $users->get(),
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

        $user = $user->update([
            ...$request->validated(),
            'hrm_user_base_schedules' => $request->hrm_user_base_schedules,
            'specialist_clinic_relations' => $request->specialist_clinic_relations,
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