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
        // Verify the user can access this function via policy
        $this->authorize('viewAny', ProdaDevice::class);

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
        // Verify the user can access this function via policy
        $this->authorize('create', ProdaDevice::class);

        $prodaDevice = ProdaDevice::create([
            ...$request->validated(),
            ...generate_public_private_keys(),
        ]);

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
        // Verify the user can access this function via policy
        $this->authorize('update', $prodaDevice);

        $prodaDevice->update([
            ...$request->validated(),
        ]);

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
        // Verify the user can access this function via policy
        $this->authorize('delete', $prodaDevice);

        $prodaDevice->delete();

        return response()->json(
            [
                'message' => 'Proda Device Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
