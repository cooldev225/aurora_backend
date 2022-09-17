<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\OrganizationCreateRequest;
use App\Http\Requests\OrganizationUpdateRequest;
use App\Models\NotificationTemplate;
use App\Models\User;
use App\Models\Organization;

class OrganizationController extends Controller
{
    /**
     * [Organization] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', Organization::class);

        return response()->json(
            [
                'message' => 'All Organizations',
                'data'    => Organization::all(),
            ],
            Response::HTTP_OK
        );
    }


    /**
     * [Organization] - Show
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', Organization::class);

        return response()->json(
            [
                'message'   => 'View Organization',
                'data'      => $organization,
            ],
            Response::HTTP_OK
        );
    }


    /**
     * [Organization] - Store
     *
     * @param  \App\Http\Requests\OrganizationCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationCreateRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', Organization::class);

        $i = 3;
        $code = substr($request->name, 0, $i);
        while(Organization::where('code', $code)->count() > 0){
            $code = substr($request->name, 0, ++$i);
        };

        $owner = User::create([
            'username'      => $code.'admin',
            'email'         => $request->email,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'password'      => Hash::make('paxxw0rd'),
            'raw_password'  => $request->password,
            'role_id'       => UserRole::ORGANIZATION_ADMIN,
            'mobile_number' => $request->mobile_number,
        ]);

        

        $organization = Organization::create([
            'name'                      => $request->name,
            'code'                      => $code,
            'owner_id'                  => $owner->id,
            ...$request->validated(),
       
        ]);

        $owner->organization_id = $organization->id;
        $owner->save();

        NotificationTemplate::CreateOrganizationNotification($organization);

        return response()->json(
            [
                'message' => 'Organization created',
                'data' => $organization,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Organization] - Update
     *
     * @param  \App\Http\Requests\OrganizationRequest  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(
        OrganizationUpdateRequest $request,
        Organization $organization
    ) {
        // Verify the user can access this function via policy
        $this->authorize('update', $organization);

        $organization->update([
            'name'                      => $request->name,
            'max_clinics'               => $request->max_clinics,
            'max_employees'             => $request->max_employees,
            'appointment_length'        => $request->appointment_length,
            'start_time'                => $request->start_time,
            'end_time'                  => $request->end_time,
            'has_billing'               => $request->has_billing,
            'has_coding'                => $request->has_coding,
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
     * [Organization] - Destroy
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $organization);

        $owner = $organization->owner;
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
