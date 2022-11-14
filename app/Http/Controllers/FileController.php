<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use Illuminate\Http\Response;
use App\Http\Requests\FileRequest;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    protected $images = [
        FileType::CLINIC_HEADER,
        FileType::CLINIC_FOOTER,
        FileType::ORGANIZATION_LOGO,
        FileType::ORGANIZATION_HEADER,
        FileType::ORGANIZATION_FOOTER,
        FileType::USER_PHOTO,
        FileType::USER_SIGNATURE,
    ];

    /**
     * Return a particular file for viewing
     *
     * @group Appointments
     * @param  \App\Http\Requests\FileRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function show(FileRequest $request) {
        $file = Storage::disk('local')->get($request->path);

        if (!$file || !canUserAccessFilePath($request->path)) {
            // If there's no file, return a 404.
            // Likely this is because the user doesn't have access
            return response()->json(
                [
                    'message'   => 'Could not find file',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        if(Storage::mimeType($file)  === 'pdf') {
            return response($file, Response::HTTP_OK)->header('Content-Type', 'application/pdf');
        }

        return response($file, Response::HTTP_OK)->header('Content-Type', 'image/png');
    }
}
