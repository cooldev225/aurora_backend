<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use Illuminate\Http\Response;
use App\Http\Requests\FileRequest;
use Illuminate\Support\Facades\Log;
use App\Models\AppointmentPreAdmission;
use App\Models\AppointmentReferral;
use App\Models\PatientDocument;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{

    /**
     * [Referral] - File
     *
     * @group Appointments
     * @param  \App\Http\Requests\FileRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function show(FileRequest $request) {
        $file_type = new \ReflectionEnum(FileType::class);

        if (!$file_type->hasConstant($request->type)) {
            //If the file type provided is not valid, return an error
            return response()->json(
                [
                    'message'   => 'Please select a valid file type',
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // Get enum associated with the submitted file type
        $file_type = $file_type->getConstant($request->type);
        $file_prefix = $file_type->value;

        $folder = config("filesystems.filepaths.{$file_prefix}");

        $model_id = getModelIdFromFilename($file_prefix, $request->path);

        switch ($file_type) {
            case FileType::REFERRAL:
                $model = AppointmentReferral::find($model_id);
                $file_owner = $model->patient()->first();
                break;
            case FileType::PRE_ADMISSION:
                $model = AppointmentPreAdmission::find($model_id);
                $file_owner = $model->patient()->first();
                break;
            case FileType::PATIENT_DOCUMENT:
                $model = PatientDocument::find($model_id);
                $file_owner = $model->patient()->first();
        }

        // Ensure the person making this request can view this document
        $this->authorize('view', $file_owner);
       
        $path = $folder . $request->path;
        $file = Storage::disk('local')->get($path);
        if(Storage::mimeType($file)  === 'pdf'){
            return response($file, 200)
            ->header('Content-Type', 'application/pdf');
        }else{
            return response($file, 200)
            ->header('Content-Type', 'image/png');
        }  
    }

}
