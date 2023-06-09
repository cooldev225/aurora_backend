<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enum\FileType;
use App\Enum\UserRole;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\NotificationTemplate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\OrganizationCreateRequest;
use App\Http\Requests\OrganizationUpdateRequest;
use App\Mail\NewEmployeeEmail;
use App\Models\PreAdmissionConsent;
use Illuminate\Support\Str;


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
        $this->authorize('update', $organization);

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

        // Create a new user as the default admin for this org
        $i = 3;
        $code = substr($request->name, 0, $i);
        while(Organization::where('code', $code)->count() > 0){
            $code = substr($request->name, 0, ++$i);
        };

        $raw_password = Str::random(14);

        $owner = User::create([
            ...$request->safe()->only([
                'email',
                'first_name',
                'last_name',
                'mobile_number',
            ]),
            'username'      => $code.'-'.$request->first_name.'-admin',
            'password'      => Hash::make($raw_password),
            'role_id'       => UserRole::ORGANIZATION_ADMIN,
        ]);

        // Creates the new org
        $organization = Organization::create([
            'name'                      => $request->name,
            'code'                      => $code,
            'owner_id'                  => $owner->id,
            ...$request->validated(),

        ]);

        // Sets the owners org id to the new org
        $owner->organization_id = $organization->id;
        $owner->save();

        // Sends the welcome email to the new user
        $owner->sendEmail(new NewEmployeeEmail($owner, $raw_password));

        // Set up the default Notification Templates for this organizations
        NotificationTemplate::CreateOrganizationNotification($organization);

        // Set up the Default pre addmision consent
        PreAdmissionConsent::create(['organization_id' => $organization->id]);

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
        $organization->update(
            $request->safe()->only([
                'max_clinics',
                'max_employees',
                'has_billing',
                'has_coding',
            ])
        );

        if ($file = $request->file('logo')) {
            $file_name = generateFileName(FileType::ORGANIZATION_LOGO, $organization->id, $file->extension());
            $org_path = getUserOrganizationFilePath('images');
            
            if (!$org_path) {
                return response()->json(
                    [
                        'message'   => 'Could not find user organization',
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
            
            $file_path = "/{$org_path}/{$file_name}";
            Storage::put($file_path, file_get_contents($file));

            $organization->logo = $file_name;
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
