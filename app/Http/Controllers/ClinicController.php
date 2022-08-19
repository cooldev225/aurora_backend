<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\ClinicRequest;
use App\Models\Clinic;
use App\Models\ProdaDevice;

class ClinicController extends BaseOrganizationController
{
    /**
     * [Clinic] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;
        $proda_device_table = (new ProdaDevice())->getTable();
        $clinic_table = (new Clinic())->getTable();

        $clinics = Clinic::select('*', "{$clinic_table}.id")
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
                'message' => 'Clinic List',
                'data' => $clinics,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Clinic] - Store
     *
     * @param  \App\Http\Requests\ClinicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClinicRequest $request)
    {
        if ($request->filled('id')) {
            $clinic = Clinic::find($request->id);
            return $this->update($request, $clinic);
        }

        $organization_id = auth()->user()->organization_id;

        $clinic = Clinic::create([
            ...$this->filterParams($request),
            'organization_id' => $organization_id,
        ]);

        $proda_device = new ProdaDevice();
        $proda_device->device_name = $request->device_name;
        $proda_device->otac = $request->otac;
        $proda_device->key_expiry = $request->key_expiry;
        $proda_device->device_expiry = $request->device_expiry;
        $proda_device->clinic_id = $clinic->id;

        $proda_device->save_with_key();

        if ($file = $request->file('header')) {
            $file_name = 'header_' . $clinic->id . '_' . time() . '.' . $file->extension();
            $header_path = '/' . $file->storeAs('images/clinic', $file_name);
            $clinic->document_letter_header = $header_path;
        }

        if ($file = $request->file('footer')) {
            $file_name = 'footer_' . $clinic->id . '_' . time() . '.' . $file->extension();
            $footer_path = '/' . $file->storeAs('images/clinic', $file_name);
            $clinic->document_letter_footer = $footer_path;
        }

        $clinic->save();

        return response()->json(
            [
                'message' => 'Clinic created',
                'data' => $clinic,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Clinic] - Update
     *
     * @param  \App\Http\Requests\ClinicRequest  $request
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(ClinicRequest $request, Clinic $clinic)
    {
        $organization_id = auth()->user()->organization_id;

        if ($clinic->organization_id != $organization_id) {
            return $this->forbiddenOrganization();
        }

        $clinic->update([
            ...$this->filterParams($request),
            'organization_id' => $organization_id,
        ]);

        $proda_device = $clinic->proda_device;
        $proda_device->device_name = $request->device_name;
        $proda_device->otac = $request->otac;
        $proda_device->key_expiry = $request->key_expiry;
        $proda_device->device_expiry = $request->device_expiry;
        $proda_device->clinic_id = $clinic->id;

        $proda_device->save_with_key();

        if ($file = $request->file('header')) {
            $file_name = 'header_' . $clinic->id . '_' . time() . '.' . $file->extension();
            $header_path = '/' . $file->storeAs('images/clinic', $file_name);
            $clinic->document_letter_header = $header_path;
        }

        if ($file = $request->file('footer')) {
            $file_name = 'footer_' . $clinic->id . '_' . time() . '.' . $file->extension();
            $footer_path = '/' . $file->storeAs('images/clinic', $file_name);
            $clinic->document_letter_footer = $footer_path;
        }

        $clinic->save();

        return response()->json(
            [
                'message' => 'Clinic updated',
                'data' => $clinic,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Clinic] - Destroy
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic)
    {
        $proda_device = $clinic->proda_device;

        if (!empty($proda_device)) {
            $proda_device->delete();
        }

        $clinic->delete();

        return response()->json(
            [
                'message' => 'Clinic Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }


    /**
     * Filter Request
     *
     * @param  \App\Http\Requests\ClinicRequest  $request
     * @return Filtered Array
     */
    protected function filterParams(ClinicRequest $request)
    {
        $returnArray = $request->all();

        foreach ($returnArray as $key => $item) {
            if (($returnArray[$key] == null) || ($returnArray[$key] == 'null')) {
                unset($returnArray[$key]);
            }
        }

        return $returnArray;
    }
}
