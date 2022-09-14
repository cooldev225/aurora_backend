<?php

namespace App\Http\Controllers;

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
            $file_name = 'logo_' . $organization->id . '_' . time() . '.' . $file->extension();
            $file->storeAs('images/organization/', $file_name);
            $organization->logo = $file_name;
        }

        if ($file = $request->file('document_letter_header')) {
            $file_name = 'header_' . $organization->id . '_' . time() . '.' . $file->extension();
            $file->storeAs('images/organization/', $file_name);
            $organization->document_letter_header = $file_name;
        }

        if ($file = $request->file('document_letter_footer')) {
            $file_name = 'footer_' . $organization->id . '_' . time() . '.' . $file->extension();
            $file->storeAs('images/organization/', $file_name);
            $organization->document_letter_footer = $file_name;
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
