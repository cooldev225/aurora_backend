<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use Illuminate\Http\Response;
use App\Http\Requests\FileRequest;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    protected $images = [];

    /**
     * Return a particular file for viewing
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

        $folder = getUserOrganizationFilePath(in_array($file_type, $this->images) ? 'images' : 'files');

        $path = "{$folder}/{$request->path}";
        $file = Storage::disk('local')->get($path);

        if (!$file) {
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
