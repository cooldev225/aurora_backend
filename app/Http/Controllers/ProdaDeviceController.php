<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\ProdaDeviceRequest;
use App\Models\ProdaDevice;

class ProdaDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;
        $proda_device_table = (new ProdaDevice())->getTable();
        $clinic_table = (new Clinic())->getTable();

        $clinics = ProdaDevice::select($proda_device_table . '.*')
            ->leftJoin(
                $proda_device_table,
                'clinic_id',
                '=',
                $clinic_table . '.id'
            )
            ->where('organization_id', $organization_id)
            ->get();

        return response()->json(
            [
                'message' => 'Proda Device List',
                'data' => $clinics,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProdaDeviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdaDeviceRequest $request)
    {
        $proda_device = new ProdaDevice();
        $proda_device->device_name = $request->device_name;
        $proda_device->otac = $request->otac;
        $proda_device->key_expiry = $request->key_expiry;
        $proda_device->device_expiry = $request->device_expiry;
        $proda_device->clinic_id = $request->clinic_id;

        $proda_device->save_with_key();

        return response()->json(
            [
                'message' => 'Proda Device created',
                'data' => $clinic,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProdaDeviceRequest  $request
     * @param  \App\Models\ProdaDevice  $prodaDevice
     * @return \Illuminate\Http\Response
     */
    public function update(
        ProdaDeviceRequest $request,
        ProdaDevice $prodaDevice
    ) {
        $proda_device = $prodaDevice;
        $proda_device->device_name = $request->device_name;
        $proda_device->otac = $request->otac;
        $proda_device->key_expiry = $request->key_expiry;
        $proda_device->device_expiry = $request->device_expiry;
        $proda_device->clinic_id = $request->clinic_id;

        $proda_device->save_with_key();

        return response()->json(
            [
                'message' => 'Proda Device updated',
                'data' => $clinic,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProdaDevice  $prodaDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdaDevice $prodaDevice)
    {
        $prodaDevice->delete();

        return response()->json(
            [
                'message' => 'Proda Device Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
