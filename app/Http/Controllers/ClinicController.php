<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClinicRequest;
use App\Http\Requests\UpdateClinicRequest;
use App\Models\Clinic;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Clinic::where(
            'organization_id',
            auth()->user()->organization_id
        )
            ->paginate()
            ->toArray();

        return response()->json(
            [
                'message' => 'Clinic List',
                'data' => $result,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClinicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClinicRequest $request)
    {
        $clinic = Clinic::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'fax_number' => $request->fax_number,
            'hospital_provider_number' => $request->hospital_provider_number,
            'VAED_number' => $request->VAED_number,
            'address' => $request->address,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'country' => $request->country,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'timezone' => $request->timezone,
            'specimen_collection_point_number' =>
                $request->specimen_collection_point_number,
            'footnote_signature' => $request->footnote_signature,
            'default_start_time' => $request->default_start_time,
            'default_end_time' => $request->default_end_time,
            'default_meal_time' => $request->default_meal_time,
            'latest_invoice_no' => $request->latest_invoice_no,
            'latest_invoice_pathology_no' =>
                $request->latest_invoice_pathology_no,
            'centre_serial_no' => $request->centre_serial_no,
            'centre_last_invoice_serial_no' =>
                $request->centre_last_invoice_serial_no,
            'lspn_id' => $request->lspn_id,
        ]);

        return response()->json(
            [
                'message' => 'Clinic successfully registered',
                'data' => $clinic,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClinicRequest  $request
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClinicRequest $request, Clinic $clinic)
    {
        $clinic->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'fax_number' => $request->fax_number,
            'hospital_provider_number' => $request->hospital_provider_number,
            'VAED_number' => $request->VAED_number,
            'address' => $request->address,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'country' => $request->country,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'timezone' => $request->timezone,
            'specimen_collection_point_number' =>
                $request->specimen_collection_point_number,
            'footnote_signature' => $request->footnote_signature,
            'default_start_time' => $request->default_start_time,
            'default_end_time' => $request->default_end_time,
            'default_meal_time' => $request->default_meal_time,
            'latest_invoice_no' => $request->latest_invoice_no,
            'latest_invoice_pathology_no' =>
                $request->latest_invoice_pathology_no,
            'centre_serial_no' => $request->centre_serial_no,
            'centre_last_invoice_serial_no' =>
                $request->centre_last_invoice_serial_no,
            'lspn_id' => $request->lspn_id,
        ]);

        return response()->json(
            [
                'message' => 'Clinic successfully updated',
                'data' => $clinic,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic)
    {
        $clinic->delete();

        return response()->json(
            [
                'message' => 'Clinic successfully Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
