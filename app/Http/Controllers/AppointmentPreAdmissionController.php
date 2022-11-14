<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Enum\FileType;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Models\AppointmentPreAdmission;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AppointmentPreAdmissionRequest;
use App\Http\Requests\AppointmentPreAdmissionValidateRequest;

class AppointmentPreAdmissionController extends Controller
{
    /**
     * [Pre Admission] - Show Initial Form
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $preAdmission = AppointmentPreAdmission::where('token', $token)
            ->first();

        if ($preAdmission == null) {
            return response()->json(
                [
                    'message'   => 'No Matching Pre-Admission',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $data = $preAdmission->getAppointmentPreAdmissionData();

        return response()->json(
            [
                'message'   => 'Appointment Pre Admission',
                'data'      => $data,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Pre Admission] - Validate Pre Admission
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function validatePreAdmission(AppointmentPreAdmissionValidateRequest $request, $token)
    {
        $preAdmission = AppointmentPreAdmission::where('token', $token)->first();

        if ($preAdmission == null) {
            return response()->json(
                [
                    'message'   => 'No Matching Pre-Admission',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $appointment = $preAdmission->appointment;
        $patient = $appointment->patient;

        $date_of_birth = Carbon::create($request->date_of_birth)->format('Y-m-d');
        $last_name = $request->last_name;

        $compare_birthday = Carbon::parse($patient->date_of_birth)->format('Y-m-d');
        if ($compare_birthday != $date_of_birth
            || strtolower($patient->last_name) != strtolower($last_name)
        ) {
            return response()->json(
                [
                    'message'   => 'Please check you have entered your Date of birth and Last name correctly.',
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY //Equivalent to a validation error
            );
        }

        $data = $preAdmission->getAppointmentPreAdmissionData();
        $preAdmission->status = 'VALIDATED';
        $preAdmission->save();

        return response()->json(
            [
                'message'   => 'Appointment Pre Admission',
                'data'      => $data,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Pre Admission] - Create Pre Admission
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentPreAdmissionRequest $request, $token)
    {
        $preAdmission = AppointmentPreAdmission::where('token', $token)->first();

        if ($preAdmission == null) {
            return response()->json(
                [
                    'message'   => 'Appointment Pre Admission',
                    'data'      => null,
                ],
                Response::HTTP_OK
            );
        }

        if ($preAdmission->status != 'VALIDATED') {
            $data = $preAdmission->getAppointmentPreAdmissionData();

            return response()->json(
                [
                    'message'   => 'Appointment Pre Admission',
                    'data'      => $data,
                ],
                Response::HTTP_OK
            );
        }

        $appointment = $preAdmission->appointment;
        $patient = $appointment->patient;

        Patient::where('id', $appointment->patient_id)->update($request->safe()->only($patient->getFillable()));
      
        $preAdmissionAnswers = json_decode($request->pre_admission_answers);

        $data = [
            'title' => 'Pre-admission form: '. $appointment->patient_name['full'],
            'date' => date('d/m/Y'),
            'preadmissionData' => $preAdmissionAnswers,
        ];


        $pdf = PDF::loadView('pdfs/patientPreAdmissionForm', $data);

        $file_name = generateFileName(FileType::PRE_ADMISSION, $preAdmission->id, 'pdf');
        $file_path = getUserOrganizationFilePath();

        Storage::put($file_path . '/' . $file_name, $pdf->output());
        $preAdmission->pre_admission_file = $file_name;
        $preAdmission->status = 'CREATED';
        $preAdmission->save();



        return response()->json(
            [
                'message'   => 'Appointment Pre Admission',
                'data'      => $data,
            ],
            Response::HTTP_OK
        );
    }


        /**
     * [Pre Admission] - Create Pre Admission
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function testPDF()
    {

        $test = '[{"id":2,"organization_id":1,"section_title":"Voluptatem aut ducimus molestias quis animi.","section_questions":[{"id":6,"pre_admission_section_id":2,"question_text":"Dolorem dicta in sequi."},{"id":9,"pre_admission_section_id":2,"question_text":"Exercitationem non vitae accusamus est perferendis et."},{"id":11,"pre_admission_section_id":2,"question_text":"Officia non nesciunt accusamus consequatur nobis."},{"id":14,"pre_admission_section_id":2,"question_text":"Modi et iusto sunt qui."},{"id":16,"pre_admission_section_id":2,"question_text":"Labore non culpa assumenda consequatur."},{"id":22,"pre_admission_section_id":2,"question_text":"Asperiores id accusamus ullam quod perspiciatis nihil voluptas eaque."},{"id":24,"pre_admission_section_id":2,"question_text":"Facilis eos unde debitis voluptas rerum."},{"id":25,"pre_admission_section_id":2,"question_text":"Consectetur asperiores magni et amet voluptatum omnis."},{"id":26,"pre_admission_section_id":2,"question_text":"Culpa iusto quae eos labore aliquam."}]},{"id":3,"organization_id":1,"section_title":"Vitae possimus quas soluta facilis.","section_questions":[{"id":19,"pre_admission_section_id":3,"question_text":"Sint quia assumenda eum ea sed.","question_answer":"aefa"},{"id":27,"pre_admission_section_id":3,"question_text":"Est in reiciendis sint sequi ut aut provident."}]},{"id":5,"organization_id":1,"section_title":"Qui sint voluptate commodi voluptatibus est voluptates.","section_questions":[{"id":1,"pre_admission_section_id":5,"question_text":"Dolores iure repellendus sunt maiores soluta illum."},{"id":2,"pre_admission_section_id":5,"question_text":"Qui voluptatum odit eum necessitatibus delectus non reprehenderit."},{"id":5,"pre_admission_section_id":5,"question_text":"Nemo reprehenderit quaerat quia sunt voluptatem aperiam animi."},{"id":8,"pre_admission_section_id":5,"question_text":"Numquam id et mollitia cupiditate."},{"id":10,"pre_admission_section_id":5,"question_text":"Facere et quasi omnis qui omnis."},{"id":12,"pre_admission_section_id":5,"question_text":"Magnam ut enim sunt ipsum expedita nemo."},{"id":13,"pre_admission_section_id":5,"question_text":"Odio deserunt vero unde eum id et."},{"id":15,"pre_admission_section_id":5,"question_text":"Ut velit aut neque eos."},{"id":17,"pre_admission_section_id":5,"question_text":"Impedit sed quas dolorem et."}]}]';
 

        $appointment = Appointment::first();
        $preAdmission = $appointment->pre_admission;
        $patient = Patient::first();

        $preAdmissionAnswers = json_decode($test);

        $data = [
            'title' => 'Pre-admission form: '. $appointment->patient_name['full'],
            'date' => date('d/m/Y'),
            'preadmissionData' => $preAdmissionAnswers,
        ];

        $pdf = PDF::loadView('pdfs/patientPreAdmissionForm', $data);

        $file_name = generateFileName(FileType::PRE_ADMISSION, $preAdmission->id, 'pdf');
        $file_path = getUserOrganizationFilePath();
       
        Storage::put($file_path . '/' . $file_name, $pdf->output());
        $file_url = url($file_path);
        $preAdmission->pre_admission_file = $file_url;
        $preAdmission->status = 'CREATED';
        $preAdmission->save();

        return 'Success';
    }

    /**
     * [Pre Admission] - Upload Pre Admission
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, Appointment $appointment)
    {
        $pre_admission = $appointment->pre_admission;

        // Verify the user can access this function via policy
        $this->authorize('update', $pre_admission);

        if ($file = $request->file('file')) {
            $file_name = generateFileName(FileType::PRE_ADMISSION, $pre_admission->id, $file->extension());
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

            $pre_admission->pre_admission_file = $file_path;
            $pre_admission->save();
        }

        return response()->json(
            [
                'message' => 'Pre Admission File Uploaded',
                'data'    => $appointment,
            ],
            Response::HTTP_OK
        );
    }
}
