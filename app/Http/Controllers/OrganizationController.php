<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\OrganizationRequest;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Organization;

class OrganizationController extends Controller
{
    /**
     * Instantiate a new AdminController instance.
     */
    public function __construct()
    {
        $this->org_role = UserRole::where('slug', 'organizationAdmin')
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
        $user_table = (new User())->getTable();

        $result = Organization::combineWithBaseUrl()
            ->leftJoin($user_table, 'owner_id', '=', $user_table . '.id')
            ->get();

        return response()->json(
            [
                'message' => 'Organization List',
                'data' => $result,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\OrganizationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationRequest $request)
    {
        $owner = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
            'role_id' => $this->org_role->id,
            'mobile_number' => $request->mobile_number,
        ]);

        $logo_path = '';

        if ($file = $request->file('logo')) {
            $logo_path = '/' . $file->store('images/logo');
        }

        $organization = Organization::create([
            'name' => $request->name,
            'logo' => $logo_path,
            'max_clinics' => $request->max_clinics,
            'max_employees' => $request->max_employees,
            'owner_id' => $owner->id,
        ]);

        return response()->json(
            [
                'message' => 'Organization created',
                'data' => $organization,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\OrganizationRequest  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(
        OrganizationRequest $request,
        Organization $organization
    ) {
        $owner = $organization->owner()->update([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => $this->org_role->id,
            'mobile_number' => $request->mobile_number,
        ]);

        $logo_path = '';

        if ($file = $request->file('logo')) {
            $logo_path = '/' . $file->store('images/logo');
        }

        $organization->update([
            'name' => $request->name,
            'logo' => $logo_path,
            'max_clinics' => $request->max_clinics,
            'max_employees' => $request->max_employees,
            'owner_id' => $owner->id,
        ]);

        return response()->json(
            [
                'message' => 'Organization updated',
                'data' => $organization,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $owner = $organization->owner();
        $owner->delete();
        $organization->delete();

        return response()->json(
            [
                'message' => 'Organization Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
