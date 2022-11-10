<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use Illuminate\Http\Request;
use App\Http\Requests\OrganizationSettingUpdateRequest;

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
        OrganizationSettingUpdateRequest $request,
    ) {
        $organization = auth()->user()->organization;
        // Verify the user can access this function via policy
        $this->authorize('update', $organization);

        $organization->update(
            $request->safe()->only([
                'name',
                'start_time',
                'end_time',
                'appointment_length',
            ])
        );

        return response()->json(
            [
                'message'   => 'Organization Settings updated',
                'data'      => $organization,
            ],
            200
        );
    }

}
