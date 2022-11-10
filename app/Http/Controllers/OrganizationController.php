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

        $i = 3;
        $code = substr($request->name, 0, $i);
        while(Organization::where('code', $code)->count() > 0){
            $code = substr($request->name, 0, ++$i);
        };

        $owner = User::create([
            ...$request->safe()->only([
                'email',
                'first_name',
                'last_name',
            ]),
            'username'      => $code.'admin',
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
            $path = Storage::put($file_path, file_get_contents($file));

            $organization->logo = $file_path;
        }

        if ($file = $request->file('header')) {
            $file_name = generateFileName(FileType::ORGANIZATION_FOOTER, $organization->id, $file->extension());
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
            $path = Storage::put($file_path, file_get_contents($file));

            $organization->document_letter_header = $file_path;
        }

        if ($file = $request->file('footer')) {
            $file_name = generateFileName(FileType::ORGANIZATION_FOOTER, $organization->id, $file->extension());
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
            $path = Storage::put($file_path, file_get_contents($file));

            $organization->document_letter_footer = $file_path;
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
