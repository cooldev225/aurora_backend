<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use Illuminate\Http\Request;

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
            $logo_path = '/' . $file->storeAs(getUserOrganizationFilePath('images'), $file_name);
            $organization->logo = $logo_path;
        }

        if ($file = $request->file('header')) {
            $file_name = generateFileName(FileType::ORGANIZATION_FOOTER, $organization->id, $file->extension());
            $header_path = '/' . $file->storeAs(getUserOrganizationFilePath('images'), $file_name);
            $organization->document_letter_header = $header_path;
        }

        if ($file = $request->file('footer')) {
            $file_name = generateFileName(FileType::ORGANIZATION_FOOTER, $organization->id, $file->extension());
            $footer_path = '/' . $file->storeAs(getUserOrganizationFilePath('images'), $file_name);
            $organization->document_letter_footer = $footer_path;
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
