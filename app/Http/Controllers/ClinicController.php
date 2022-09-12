<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\ClinicRequest;
use App\Models\Clinic;
use App\Models\ProdaDevice;

class ClinicController extends Controller
{
    /**
     * [Clinic] - List
     *
     * List all clinics thats are a part of the organization of the currently logged in user
     * 
     * @group Clinics
     * @responseFile storage/responses/clinics.index.json
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', Clinic::class);

        $organization_id = auth()->user()->organization_id;

        $clinics = Clinic::where('organization_id', $organization_id)
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
     * @group Clinics
     * @param  \App\Http\Requests\ClinicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClinicRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', Clinic::class);

        $clinic = Clinic::create([
            'organization_id'           => auth()->user()->organization_id,
            ...$request->safe()->except(['document_letter_header', 'document_letter_footer']),
        ]);


        if ($file = $request->file('document_letter_header')) {
            $file_name = 'header_' . $clinic->id . '_' . time() . '.' . $file->extension();
            $header_path = '/' . $file->storeAs('images/clinic', $file_name);
            $clinic->document_letter_header = $header_path;
        }

        if ($file = $request->file('document_letter_footer')) {
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
     * @group Clinics
     * @param  \App\Http\Requests\ClinicRequest  $request
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(ClinicRequest $request, Clinic $clinic)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $clinic);
  
        $clinic->update($request->safe()->except(['document_letter_header', 'document_letter_footer']));

        if ($file = $request->file('document_letter_header')) {
            $file_name = 'header_' . $clinic->id . '_' . time() . '.' . $file->extension();
            $header_path = '/' . $file->storeAs('images/clinic', $file_name);
            $clinic->document_header = $header_path;
        }

        if ($file = $request->file('document_letter_footer')) {
            $file_name = 'footer_' . $clinic->id . '_' . time() . '.' . $file->extension();
            $footer_path = '/' . $file->storeAs('images/clinic', $file_name);
            $clinic->document_footer = $footer_path;
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
     * @group Clinics
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $clinic);

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

}
