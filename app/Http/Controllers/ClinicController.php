<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\ClinicRequest;
use App\Models\Clinic;
use App\Models\ProvaDevice;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prova_device_table = (new ProvaDevice())->getTable();
        $clinic_table = (new Clinic())->getTable();

        $clinics = Clinic::leftJoin(
            $prova_device_table,
            'clinic_id',
            '=',
            $clinic_table . '.id'
        )
            ->where('organization_id', auth()->user()->organization_id)
            ->get();

        return response()->json(
            [
                'message' => 'Clinic List',
                'data' => $clinics,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClinicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClinicRequest $request)
    {
        $clinic = Clinic::create([
            'organization_id' => auth()->user()->organization_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
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

        $prova_device = new ProvaDevice();
        $prova_device->device_name = $request->device_name;
        $prova_device->otac = $request->otac;
        $prova_device->key_expiry = $request->key_expiry;
        $prova_device->device_expiry = $request->device_expiry;
        $prova_device->clinic_id = $clinic->id;

        $prova_device->save_with_key();

        return response()->json(
            [
                'message' => 'Clinic created',
                'data' => $clinic,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ClinicRequest  $request
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(ClinicRequest $request, Clinic $clinic)
    {
        $clinic->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
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

        $prova_device = new ProvaDevice();
        $prova_device->device_name = $request->device_name;
        $prova_device->otac = $request->otac;
        $prova_device->key_expiry = $request->key_expiry;
        $prova_device->device_expiry = $request->device_expiry;
        $prova_device->clinic_id = $clinic->id;

        $prova_device->save_with_key();

        return response()->json(
            [
                'message' => 'Clinic updated',
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
        $prova_device = $clinic->prova_device();
        $prova_device->delete();
        $clinic->delete();

        return response()->json(
            [
                'message' => 'Clinic Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * Switch Clinic.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function switchClinic(Request $request)
    {
        $user = auth()->user();
        $user->update(['clinic_id' => $requst->clinic_id]);

        return response()->json(
            [
                'message' => 'Clinic Switched',
            ],
            Response::HTTP_OK
        );
    }
}
