<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\OrganizationRequest;
use App\Models\User;
use App\Models\UserRole;
use App\Models\ProvaDevice;
use App\Models\Organization;

class OrganizationController extends Controller
{
    /**
     * Instantiate a new AdminController instance.
     */
    public function __construct()
    {
        $this->org_role = UserRole::where('slug', 'organization-admin')
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
        $prova_device_table = (new ProvaDevice())->getTable();
        $user_table = (new User())->getTable();

        $result = Organization::leftJoin(
            $prova_device_table,
            'prova_device_id',
            '=',
            $prova_device_table . '.id'
        )
            ->leftJoin($user_table, 'owner_id', '=', $user_table . '.id')
            ->get()
            ->toArray();

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

        $prova_device = new ProvaDevice();
        $prova_device->device_name = $request->device_name;
        $prova_device->otac = $request->otac;
        $prova_device->key_expiry = $request->key_expiry;
        $prova_device->device_expiry = $request->device_expiry;

        $prova_device->save_with_key();
        $logo_path = '';

        if ($file = $request->file('logo')) {
            $logo_path = $file->store('public/logo');
        }

        $organization = Organization::create([
            'name' => $request->name,
            'logo' => $logo_path,
            'max_clinics' => $request->max_clinics,
            'max_employees' => $request->max_employees,
            'prova_device_id' => $prova_device->id,
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
            'password' => Hash::make($request->password),
            'role_id' => $this->org_role->id,
            'mobile_number' => $request->mobile_number,
        ]);

        $prova_device = $organization->prova_device();
        $prova_device->device_name = $request->device_name;
        $prova_device->otac = $request->otac;
        $prova_device->key_expiry = $request->key_expiry;
        $prova_device->device_expiry = $request->device_expiry;

        $prova_device->save_with_key();
        $logo_path = '';

        if ($file = $request->file('logo')) {
            $logo_path = $file->store('public/logo');
        }

        $organization->update([
            'name' => $request->name,
            'logo' => $logo_path,
            'max_clinics' => $request->max_clinics,
            'max_employees' => $request->max_employees,
            'prova_device_id' => $prova_device->id,
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
        $prova_device = $organization->prova_device();
        $owner->delete();
        $prova_device->delete();
        $organization->delete();

        return response()->json(
            [
                'message' => 'Organization Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
