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
            $folder = "appointment_referral/";
        }else if($request->type === "PRE_ADMISSION"){
            $folder = "appointment_pre_admission/";
        } 

       
        $path = 'files/' . $folder . $request->path;
        Log::info($path);
        return response(Storage::disk('local')->get($path), 200)
              ->header('Content-Type', 'application/pdf');
    }


}
