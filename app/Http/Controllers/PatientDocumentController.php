<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use App\Enum\DocumentActionStatusType;
use App\Enum\OutMessageSendMethod;
use App\Enum\OutMessageSendStatus;
use App\Models\Patient;
use Illuminate\Http\Response;
use App\Models\PatientDocument;
use App\Models\PatientDocumentsActionLog;
use App\Models\OutgoingMessageLog;
use App\Models\DoctorAddressBook;
use App\Models\SpecialistClinicRelation;
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
        $patient_document = PatientDocument::find($params['document_id']);
        $document_path = $patient_document->file_path;

        $specialist = $patient_document->specialist;
        $appointment = $patient_document->appointment;
        $sending_provider_number = SpecialistClinicRelation::
            where('specialist_id', $specialist->id)
            ->where('clinic_id', $appointment->clinic_id)
            ->first();
        $patient = $patient_document->patient;


        $folder = getUserOrganizationFilePath('files');

        $document_path = "{$folder}/{$document_path}";

        $organization_name = "\"" . auth()->user()->organization->name . "\"";


        foreach($params['to_user_emails'] as $email) {
            Mail::to($email)->send(new DocumentEmail($organization_name, $document_path));
            $receivingDoctor = DoctorAddressBook::where('practice_email', '=', $email)->first();

            $receivingDoctor && OutgoingMessageLog::create([
                'send_method'                   => OutMessageSendMethod::EMAIL,
                'send_status'                   => OutMessageSendStatus::SENT,
                'sending_doctor_name'           => $specialist->full_name,
                'sending_doctor_provider'       => $sending_provider_number->provider_number,
                'receiving_doctor_name'         => $receivingDoctor->full_name,
                'receiving_doctor_provider'     => $receivingDoctor->provider_no,
                'organization_id'               => $patient_document->organization_id,
                'patient_id'                    => $patient->id,
                'sending_doctor_user'           => $specialist->id,
                'sending_user'                  => auth()->user()->id,
                'message_contents'              => '',
            ]);
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
