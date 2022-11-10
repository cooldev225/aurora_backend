<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class OrganizationSettingsController extends Controller
{
 /**
     * [Organization] - Updates the organization settings
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
    ) {
        $organization = auth()->user()->organization;
        // Verify the user can access this function via policy
        $this->authorize('update', $organization);

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
                'message'   => 'Organization Settings updated',
                'data'      => $organization,
            ],
            200
        );
    }

}
