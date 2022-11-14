<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Response;
use App\Http\Requests\OrganizationPinRequest;
use Exception;

class OrganizationPinController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        // Verify the user can access this function via policy
        $this->authorize('showPin', $organization);

        return response()->json(
            [
                'pin' => $organization->billing_pin,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function set(OrganizationPinRequest $request, Organization $organization)
    {
        // Verify the user can access this function via policy
        $this->authorize('setPin', $organization);

        $organization->billing_pin = $request->pin;
        $organization->save();

        return response()->json(
            [
                'message' => 'Organization pin set',
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify(OrganizationPinRequest $request, Organization $organization)
    {
        // Verify the user can access this function via policy
        $this->authorize('verifyPin', $organization);

        return response()->json(
            [
                'verified' => $request->pin == $organization->billing_pin,
            ],
            Response::HTTP_OK
        );
    }
}
