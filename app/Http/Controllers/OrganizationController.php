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
        $this->organization_admin_role = UserRole::where(
            'slug',
            'organizationAdmin'
        )->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_table = (new User())->getTable();

        $result = null;
        $message = '';

        if (auth()->user()->isAdmin()) {
            $result = Organization::combineWithBaseUrl()
                ->leftJoin($user_table, 'owner_id', '=', $user_table . '.id')
                ->get();

            $message = 'Organization List';
        } else {
            $result = Organization::combineWithBaseUrl()
                ->leftJoin($user_table, 'owner_id', '=', $user_table . '.id')
                ->where('organization_id', auth()->user()->organization_id)
                ->first();

            $message = 'Current Organization Info';
        }

        return response()->json(
            [
                'message' => $message,
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
            'username'      => $request->username,
            'email'         => $request->email,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'password'      => Hash::make($request->password),
            'role_id'       => $this->organization_admin_role->id,
            'mobile_number' => $request->mobile_number,
        ]);

        $organization = Organization::create([
            'name'                      => $request->name,
            'max_clinics'               => $request->max_clinics,
            'max_employees'             => $request->max_employees,
            'owner_id'                  => $owner->id,
        ]);

        $owner->organization_id = $organization->id;
        $owner->save();
        if ($file = $request->file('logo')) {
            $file_name = 'logo_' . $organization->id . '_' . time() . '.' . $file->extension();
            $logo_path = '/' . $file->storeAs('images/organization', $file_name);
            $organization->logo = $logo_path;
        }

        if ($file = $request->file('header')) {
            $file_name = 'header_' . $organization->id . '_' . time() . '.' . $file->extension();
            $header_path = '/' . $file->storeAs('images/organization', $file_name);
            $organization->document_letter_header = $header_path;
        }

        if ($file = $request->file('footer')) {
            $file_name = 'footer_' . $organization->id . '_' . time() . '.' . $file->extension();
            $footer_path = '/' . $file->storeAs('images/organization', $file_name);
            $organization->document_letter_footer = $footer_path;
        }

        $organization->save();

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
        $owner = $organization->owner();
        $owner->update([
            'username'      => $request->username,
            'email'         => $request->email,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'role_id'       => $this->organization_admin_role->id,
            'mobile_number' => $request->mobile_number,
        ]);

        $organization->update([
            'name'                      => $request->name,
            'max_clinics'               => $request->max_clinics,
            'max_employees'             => $request->max_employees,
            'owner_id'                  => $owner->id,
        ]);

        if ($file = $request->file('logo')) {
            $file_name = 'logo_' . $organization->id . '_' . time() . '.' . $file->extension();
            $logo_path = '/' . $file->storeAs('images/organization', $file_name);
            $organization->logo = $logo_path;
        }

        if ($file = $request->file('header')) {
            $file_name = 'header_' . $organization->id . '_' . time() . '.' . $file->extension();
            $header_path = '/' . $file->storeAs('images/organization', $file_name);
            $organization->document_letter_header = $header_path;
        }

        if ($file = $request->file('footer')) {
            $file_name = 'footer_' . $organization->id . '_' . time() . '.' . $file->extension();
            $footer_path = '/' . $file->storeAs('images/organization', $file_name);
            $organization->document_letter_footer = $footer_path;
        }

        $organization->save();

        return response()->json(
            [
                'message'   => 'Organization updated',
                'data'      => $organization,
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
