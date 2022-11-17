<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use App\Enum\DocumentActionStatusType;
use App\Models\Patient;
use Illuminate\Http\Response;
use App\Models\PatientDocument;
use App\Models\PatientDocumentsActionLog;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PatientDocumentRequest;
use App\Http\Requests\PatientDocumentEmailSendRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentEmail;

class PatientDocumentController extends Controller
{
    /**
     * [Patient Document] - Store
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientDocumentRequest $request, Patient $patient)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientDocument::class);

        $org_id = auth()->user()->organization->id;

        $patient_document = PatientDocument::create([
            ...$request->validated(),
            'patient_id'     => $patient->id,
            'created_by'     => auth()->user()->id,
            'is_updatable'   => false,
            'origin'         => 'UPLOADED',
            'organization_id' => $org_id
        ]);

        if ($file = $request->file('file')) {
            $file_name = generateFileName(FileType::PATIENT_DOCUMENT, $patient_document->id, $file->extension(), time());
            $file_path = '/' . getUserOrganizationFilePath() . '/' . $file_name;
            Storage::put($file_path, file_get_contents($file));

            $patient_document->file_type =  $file->extension();
            $patient_document->file_path = $file_name;
            $patient_document->save();
        }

        return response()->json(
            [
                'message' => 'Patient Document Created',
                'data'    => $patient_document
            ],
            Response::HTTP_CREATED
        );
    }

    public function email(PatientDocumentEmailSendRequest $request)
    {

        $params = $request->validated();
        $document_path = PatientDocument::find($params['document_id'])->file_path;

        $folder = getUserOrganizationFilePath('files');

        $document_path = "{$folder}/{$document_path}";

        $organization_name = "\"" . auth()->user()->organization->name . "\"";


        foreach($params['to_user_emails'] as $email) {
            Mail::to($email)->send(new DocumentEmail($organization_name, $document_path));
        }

        $data = PatientDocumentsActionLog::create([
            'patient_document_id'   => $params['document_id'],
            'user_id'               => auth()->user()->id,
            'status'                => DocumentActionStatusType::EMAILED,
        ]);

        return response()->json(
            [
                'message' => 'Patient Document Created',
                'data'    => $data,
            ],
            Response::HTTP_CREATED
        );
    }
}
