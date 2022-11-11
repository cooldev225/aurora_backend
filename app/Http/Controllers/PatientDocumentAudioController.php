<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use App\Models\Patient;
use Illuminate\Http\Response;
use App\Models\PatientDocument;
use App\Models\PatientSpecialistAudio;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PatientDocumentAudioStoreRequest;
use App\Http\Requests\PatientDocumentAudioUpdateRequest;
use App\Http\Requests\PatientDocumentAudioUploadRequest;

class PatientDocumentAudioController extends Controller
{
    /**
     * [Patient Document Audio] - Store
     *
     * @param  \App\Http\Requests\PatientDocumentAudioStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientDocumentAudioStoreRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientDocument::class);
        $this->authorize('create', PatientSpecialistAudio::class);

        $user_id = auth()->user()->id;
        $data = [
            ...$request->all(),
            'document_type' => 'AUDIO',
            'created_by'    => $user_id,
        ];
        $patient_document = PatientDocument::create($data);

        $file_path = '';
        if ($file = $request->file('file')) {
            $file_name = generateFileName(FileType::PATIENT_DOCUMENT, $patient_document->id, $file->extension(), time());
            $org_path = getUserOrganizationFilePath();
            
            if (!$org_path) {
                return response()->json(
                    [
                        'message'   => 'Could not find user organization',
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
            
            $file_path = "/{$org_path}/{$file_name}";
            $path = Storage::put($file_path, file_get_contents($file));

            $file_type = $patient_document->getFileType($file->extension());

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

    /**
     * [Patient Document Audio] - Update
     *
     */
    public function update(
        PatientDocumentAudioUpdateRequest $request,
        PatientSpecialistAudio $patient_documents_audio
    ) {
        $patient_document = $patient_documents_audio->patient_document;

        // Verify the user can access this function via policy
        $this->authorize('update', $patient_document);
        $this->authorize('update', $patient_documents_audio);

        $data = $request->all();
        if ($file = $request->file('file')) {
            $file_name = generateFileName(FileType::PATIENT_DOCUMENT, $patient_document->id, $file->extension(), time());
            $org_path = getUserOrganizationFilePath();
            
            if (!$org_path) {
                return response()->json(
                    [
                        'message'   => 'Could not find user organization',
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
            
            $file_path = "/{$org_path}/{$file_name}";
            $path = Storage::put($file_path, file_get_contents($file));

            $file_type = $patient_document->getFileType($file->extension());

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

    /**
     * [Patient Document Audio] - Upload
     */
    public function upload(
        Patient $patient,
        PatientDocumentAudioUploadRequest $request
    ) {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientDocument::class);
        $this->authorize('create', PatientSpecialistAudio::class);

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
            $file_name = generateFileName(FileType::PATIENT_DOCUMENT, $patient_document->id, $file->extension(), time());
            $org_path = getUserOrganizationFilePath();
            
            if (!$org_path) {
                return response()->json(
                    [
                        'message'   => 'Could not find user organization',
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
            
            $file_path = "/{$org_path}/{$file_name}";
            $path = Storage::put($file_path, file_get_contents($file));

            $file_type = $patient_document->getFileType($file->extension());

            $patient_document->file_path = $file_path;
            $patient_document->file_type = $file_type;
            $patient_document->save();
        }

        PatientSpecialistAudio::create([
            ...$request->all(),
            'patient_id'          => $patient->id,
            'patient_document_id' => $patient_document->id,
            'file_path'           => url($file_path),
            'translated_by'       => $user_id,
        ]);

        return response()->json(
            [
                'message' => 'Patient Audio Uploaded',
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Patient Document Audio] - Destroy
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientSpecialistAudio $patient_documents_audio)
    {
        $patient_document = $patient_documents_audio->patient_document;

        // Verify the user can access this function via policy
        $this->authorize('delete', $patient_document);
        $this->authorize('delete', $patient_documents_audio);

        $patient_document->delete();
        $patient_documents_audio->delete();

        return response()->json(
            [
                'message' => 'Patient Specialist Audio Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
