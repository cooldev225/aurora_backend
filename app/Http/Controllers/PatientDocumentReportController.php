<?php

namespace App\Http\Controllers;

use App\Enum\DocumentOrigin;
use App\Enum\DocumentType;
use App\Enum\FileType;
use App\Http\Requests\PatientDocumentReportStoreRequest;
use App\Http\Requests\PatientDocumentReportUpdateRequest;
use App\Http\Requests\PatientDocumentReportUploadRequest;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\PatientDocument;
use App\Models\PatientReport;
use App\Models\ReportSection;
use App\Models\ReportAutoText;
use App\Models\SpecialistClinicRelation;

use PDF;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class PatientDocumentReportController extends Controller
{
    /**
     * [Patient Document Report] - Store
     *
     * @param  \App\Http\Requests\PatientDocumentLetterStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientDocumentReportStoreRequest $request, Patient $patient)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientDocument::class);

        $file_type = 'PDF';
        $reportData = array();
        foreach ($request->reportData as $data) {
            $sectionTitle = ReportSection::find($data['sectionId'])->title;
            $text = $data['free_text_default'];
            $tempAutoTextData = array();
            foreach($data['value'] as $key) {
                $autoText = ReportAutoText::find($key)->text;
                array_push($tempAutoTextData, $autoText);
            }
            $value = [$sectionTitle, $text, $tempAutoTextData];
            array_push($reportData, $value);
        }

        $clinic_id = Appointment::find($request->appointmentId)->clinic_id;
        // $provider_number = SpecialistClinicRelation::where('specialist_id', '=', $request->specialistId)->where('clinic_id', '=', $clinic_id)->first()->provider_number;
        $provider_number = SpecialistClinicRelation::where('specialist_id', '=', auth()->user()->id)->where('clinic_id', '=', $clinic_id)->first()->provider_number;

        $pdfData = [
            'title'           => 'Patient Document Report',
            'patientName'     => $request->patientName,
            'referringDoctor' => $request->referringDoctor,
            'date'            => date('d/m/Y'),
            'reportData'      => $reportData,
            'header_image'    => 'images/'.auth()->user()->organization_id.'/'. auth()->user()->organization->document_letter_header,
            'footer_image'    => 'images/'.auth()->user()->organization_id.'/'. auth()->user()->organization->document_letter_footer,
            'signature_image' => 'images/'.auth()->user()->organization_id.'/'. auth()->user()->signature,
            'full_name'         => auth()->user()->first_name . ' ' . auth()->user()->last_name,
            'sign_off'          => auth()->user()->sign_off,
            'education_code'    => auth()->user()->education_code,
            'provider_number'   => $provider_number,
        ];

        $pdf = PDF::loadView('pdfs/patientDocumentReport', $pdfData);

        $patient_document = PatientDocument::create([
            'patient_id'        => $patient->id,
            'appointment_id'    => $request->appointmentId,
            'specialist_id'     => $request->specialistId,
            'document_name'     => $request->documentName,
            'document_type'     => DocumentType::REPORT,
            'file_type'         => $file_type,
            'origin'            => DocumentOrigin::CREATED,
            'created_by'        => auth()->user()->id,
            'is_updatable'      => true,
            'organization_id'   => auth()->user()->organization_id,
        ]);


        $file_name = generateFileName(FileType::PATIENT_DOCUMENT, $patient_document->id, 'pdf');
        $file_path = getUserOrganizationFilePath();

        Storage::put($file_path . '/' . $file_name, $pdf->output());
        $patient_document->file_path = $file_name;
        $patient_document->save();

        // Create PAtient Report Model for future editing

        return response()->json(
            [
                'message' => 'New Patient Report Created',
                'data'    => $patient_document->id,
            ],
            Response::HTTP_CREATED
        );
    }


    /**
     * [Patient Document Report] - Update
     *
     * @param  \App\Http\Requests\PatientDocumentLetterUpdateRequest  $request
     * @param  \App\Models\PatientLetter  $patient_documents_letter
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientDocumentReportUpdateRequest $request,
        PatientReport $patient_documents_report
    ) {
        // Verify the user can access this function via policy
        $this->authorize('update', $patient_documents_report);

        return response()->json(
            [
                'message' => 'Not Implemented',
            ],
            Response::HTTP_CREATED
        );
    }


    /**
     * [Patient Document Report] - Destroy
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientReport $patientReport)
    {
        $patient_document = $patientReport->patient_document;

        // Verify the user can access this function via policy
        $this->authorize('delete', $patient_document);
        $this->authorize('delete', $patientReport);

        $patient_document->delete();
        $patientReport->delete();

        return response()->json(
            [
                'message' => 'Patient Report Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
