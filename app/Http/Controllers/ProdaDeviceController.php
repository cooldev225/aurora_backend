<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\ProdaDeviceRequest;
use App\Models\Clinic;
use App\Models\ProdaDevice;

class ProdaDeviceController extends Controller
{
    /**
     * [Proda Device] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;
        $proda_device_table = (new ProdaDevice())->getTable();
        $clinic_table = (new Clinic())->getTable();

        $proda_devices = ProdaDevice::select($proda_device_table . '.*')
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
                'data' => $proda_devices,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Proda Device] - Store
     *
     * @param  \App\Http\Requests\ProdaDeviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdaDeviceRequest $request)
    {
        $prodaDevice = new ProdaDevice();
        $prodaDevice->device_name = $request->device_name;
        $prodaDevice->otac = $request->otac;
        $prodaDevice->key_expiry = $request->key_expiry;
        $prodaDevice->device_expiry = $request->device_expiry;
        $prodaDevice->clinic_id = $request->clinic_id;

        $prodaDevice->save_with_key();

        return response()->json(
            [
                'message' => 'Proda Device created',
                'data' => $prodaDevice,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Proda Device] - Update
     *
     * @param  \App\Http\Requests\ProdaDeviceRequest  $request
     * @param  \App\Models\ProdaDevice  $prodaDevice
     * @return \Illuminate\Http\Response
     */
    public function update(
        ProdaDeviceRequest $request,
        ProdaDevice $prodaDevice
    ) {
        $prodaDevice->device_name = $request->device_name;
        $prodaDevice->otac = $request->otac;
        $prodaDevice->key_expiry = $request->key_expiry;
        $prodaDevice->device_expiry = $request->device_expiry;
        $prodaDevice->clinic_id = $request->clinic_id;

        $prodaDevice->save_with_key();

        return response()->json(
            [
                'message' => 'Proda Device updated',
                'data' => $prodaDevice,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Proda Device] - Destroy
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
