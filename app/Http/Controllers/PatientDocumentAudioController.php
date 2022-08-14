<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientDocumentAudioRequest;
use App\Models\PatientSpecialistAudio;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientDocumentAudioController extends Controller
{

    public function store(PatientDocumentAudioRequest $request)
    {

        $file_path = 'uploaded audio file path';
        PatientSpecialistAudio::create([
            'patient_id' => $request->patient_id,
            'specialist_id' => $request->specialist_id,
            'file' => $file_path,
        ]);

        return response()->json(
            [
                'message' => 'New Patient Audio created',
            ],
            Response::HTTP_CREATED
        );
    }


    public function destroy(PatientSpecialistAudio $patientSpecialistAudio)
    {
        $patientSpecialistAudio->delete();

        return response()->json(
            [
                'message' => 'Patient Specialist Audio Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
