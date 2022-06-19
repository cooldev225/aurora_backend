<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Organization::all()->toArray();

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
        $organization = Organization::create([
            'name' => $request->name,
            'logo' => $request->logo,
            'max_clinics' => $request->max_clinics,
            'max_employees' => $request->max_employees,
            'prova_device_id' => $request->prova_device_id,
            'owner' => $request->owner,
        ]);

        return response()->json(
            [
                'message' => 'Organization successfully created',
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
        $organization->update([
            'name' => $request->name,
            'logo' => $request->logo,
            'max_clinics' => $request->max_clinics,
            'max_employees' => $request->max_employees,
            'prova_device_id' => $request->prova_device_id,
            'owner' => $request->owner,
        ]);

        return response()->json(
            [
                'message' => 'Organization successfully updated',
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
        $organization->delete();

        return response()->json(
            [
                'message' => 'Organization successfully Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
