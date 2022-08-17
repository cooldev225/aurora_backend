<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientDocumentAudioStoreRequest;
use App\Http\Requests\PatientDocumentAudioUpdateRequest;
use App\Http\Requests\PatientDocumentAudioUploadRequest;
use App\Models\Patient;
use App\Models\PatientDocument;
use App\Models\PatientSpecialistAudio;
use Illuminate\Http\Response;

class PatientDocumentAudioController extends Controller
{
    public function store(PatientDocumentAudioStoreRequest $request)
    {
        $user_id = auth()->user()->id;
        $data = [
            ...$request->all(),
            'document_type' => 'AUDIO',
            'created_by'    => $user_id,
        ];
        $patient_document = PatientDocument::create($data);

        $file_path = '';
        if ($file = $request->file('file')) {
            $file_extension = $file->extension();
            $file_name = 'patient_specialist_audio_' . $patient_document->id
                . '_' . time() . '.' . $file_extension;
            $file_path = '/' . $file->storeAs('files/patient_documents', $file_name);
            $file_type = $patient_document->getFileType($file_extension);

            $patient_document->file_path = $file_path;
            $patient_document->file_type = $file_type;
            $patient_document->save();
        }

        PatientSpecialistAudio::create([
            ...$request->all(),
            'patient_document_id' => $patient_document->id,
            'file_path'           => $file_path,
            'translated_by'       => $user_id,
        ]);

        return response()->json(
            [
                'message' => 'New Patient Audio Created',
            ],
            Response::HTTP_CREATED
        );
    }

    public function update(
        PatientDocumentAudioUpdateRequest $request,
        PatientSpecialistAudio $patient_documents_audio
    ) {
        $patient_document = $patient_documents_audio->patient_document;

        $data = $request->all();
        if ($file = $request->file('file')) {
            $file_extension = $file->extension();
            $file_name = 'patient_specialist_audio_' . $patient_document->id
                . '_' . time() . '.' . $file_extension;
            $file_path = '/' . $file->storeAs('files/patient_documents', $file_name);
            $file_type = $patient_document->getFileType($file_extension);

            $data['file_path'] = $file_path;
            $data['file_type'] = $file_type;
        }

        $patient_documents_audio->update($data);
        $patient_document->update($data);

        return response()->json(
            [
                'message' => 'Patient Specialist Audio Updated',
            ],
            Response::HTTP_CREATED
        );
    }

    public function upload(
        Patient $patient,
        PatientDocumentAudioUploadRequest $request
    ) {
        $user_id = auth()->user()->id;
        $data = [
            ...$request->all(),
            'patient_id'    => $patient->id,
            'document_type' => 'AUDIO',
            'created_by'    => $user_id,
        ];
        $patient_document = PatientDocument::create($data);

        $file_path = '';
        if ($file = $request->file('file')) {
            $file_extension = $file->extension();
            $file_name = 'patient_specialist_audio_' . $patient_document->id
                . '_' . time() . '.' . $file_extension;
            $file_path = '/' . $file->storeAs('files/patient_documents', $file_name);
            $file_type = $patient_document->getFileType($file_extension);

            $patient_document->file_path = $file_path;
            $patient_document->file_type = $file_type;
            $patient_document->save();
        }

        PatientSpecialistAudio::create([
            ...$request->all(),
            'patient_id'          => $patient->id,
            'patient_document_id' => $patient_document->id,
            'file_path'           => $file_path,
            'translated_by'       => $user_id,
        ]);

        return response()->json(
            [
                'message' => 'Patient Audio Uploaded',
            ],
            Response::HTTP_CREATED
        );
    }

    public function destroy(PatientSpecialistAudio $patient_documents_audio)
    {
        $patient_documents_audio->patient_document->delete();
        $patient_documents_audio->delete();

        return response()->json(
            [
                'message' => 'Patient Specialist Audio Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
