<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use Illuminate\Support\Facades\Log;
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
        $folder = "";
        if($request->type === "REFERRAL"){
            $folder = "files/appointment_referral/";
        }else if($request->type === "PRE_ADMISSION"){
            $folder = "files/appointment_pre_admission/";
        }else if($request->type === "PATIENT_DOCUMENT"){
            $folder = "files/patient_documents/";
        }
       
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
