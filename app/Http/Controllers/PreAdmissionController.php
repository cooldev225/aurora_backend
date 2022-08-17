<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreAdmissionConsentRequest;
use App\Http\Requests\PreAdmissionSectionRequest;
use App\Models\PreAdmissionConsent;
use App\Models\PreAdmissionSection;
use Illuminate\Http\Response;

class PreAdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;

        $pre_admission_section = PreAdmissionSection::where(
            'organization_id',
            $organization_id
        )
            ->with('questions')
            ->get();

        return response()->json(
            [
                'message' => 'Pre Admission Section List',
                'data' => $pre_admission_section,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PreAdmissionSectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PreAdmissionSectionRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $pre_admission_section = PreAdmissionSection::createSection([
            'organization_id' => $organization_id,
            'title' => $request->title,
            'questions_data' => $request->questions_data,
        ]);

        return response()->json(
            [
                'message' => 'New Pre Admission Section created',
                'data' => $pre_admission_section,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PreAdmissionSectionRequest  $request
     * @param  \App\Models\PreAdmissionSection  $pre_admission_section
     * @return \Illuminate\Http\Response
     */
    public function update(
        PreAdmissionSectionRequest $request,
        PreAdmissionSection $pre_admission_section
    ) {
        $organization_id = auth()->user()->organization_id;

        $pre_admission_section = $pre_admission_section->update([
            'organization_id' => $organization_id,
            'title' => $request->title,
            'questions_data' => $request->questions_data,
        ]);

        return response()->json(
            [
                'message' => 'Pre Admission Section updated',
                'data' => $pre_admission_section,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreAdmissionSection  $pre_admission_section
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreAdmissionSection $pre_admission_section)
    {
        $pre_admission_section->delete();

        return response()->json(
            [
                'message' => 'Pre Admission Section Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }

    public function updateConsent(PreAdmissionConsentRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $pre_admission_consent = PreAdmissionConsent::where(
            'organization_id',
            $organization_id
        )->firstOrCreate();

        $pre_admission_consent->update([
            'organization_id' => $organization_id,
            'text' => $request->text,
        ]);

        return response()->json(
            [
                'message' => 'Pre Admission Consent updated',
                'data' => $pre_admission_consent,
            ],
            Response::HTTP_OK
        );
    }
}
