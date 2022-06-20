<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\PatientRequest;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * Instantiate a new AdminController instance.
     */
    public function __construct()
    {
        $this->organization_id = auth()->user()->organization_id;

        $this->is_admin = auth()
            ->user()
            ->isAdmin();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($clinic_id)
    {
        $patients = [];

        if ($this->is_admin) {
            $patients = Patient::where('clinic_id', $clinic_id)
                ->get()
                ->toArray();
        } else {
            $patients = Patient::where(
                'organization_id',
                $this->organization_id
            )
                ->where('clinic_id', $clinic_id)
                ->get()
                ->toArray();
        }

        return response()->json(
            [
                'message' => 'Patient List',
                'data' => $patients,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request, $clinic_id)
    {
        $patient = Patient::create([
            'organization_id' => $this->organization_id,
            'clinic_id' => $clinic_id,
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'country' => $request->country,
        ]);

        return response()->json(
            [
                'message' => 'Patient created',
                'data' => $patient,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientRequest $request,
        $clinic_id,
        Patient $patient
    ) {
        $patient->update([
            'organization_id' => $this->organization_id,
            'clinic_id' => $clinic_id,
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'country' => $request->country,
        ]);

        return response()->json(
            [
                'message' => 'Patient updated',
                'data' => $patient,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($clinic_id, Patient $patient)
    {
        $patient->delete();

        return response()->json(
            [
                'message' => 'Patient Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
