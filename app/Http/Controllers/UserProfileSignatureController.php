<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignatureUpdateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Enum\FileType;
use App\Enum\ImageType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UserProfileSignatureController extends Controller
{

    /**
     * [User] - Update Password
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $user = auth()->user();
        $this->authorize('updateProfile', $user);
        $folder = getUserOrganizationFilePath('images');
        $file_name = generateFileName(FileType::USER_SIGNATURE, $user->id, 'png');

        $path = "{$folder}/{$file_name}";

        $file = Storage::disk('local')->get($path);
        Log::info($path);
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

        return response($file, Response::HTTP_OK)->header('Content-Type', 'image/png');
    }

    /**
     * [User] - Update Password
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function update(SignatureUpdateRequest $request)
    {
        $params = $request->validated();
        $user = auth()->user();

        // Verify the user can access this function via policy
        $this->authorize('updateProfile', $user);

        $file_name = generateFileName(FileType::USER_SIGNATURE, $user->id, 'png');
        $image = $params['signature'];

        $image = str_replace('data:image/'.ImageType::PNG->value.';base64,', '', $image);
        $image = str_replace('data:image/'.ImageType::JPEG->value.';base64,', '', $image);

        $image = str_replace(' ', '+', $image);
        Storage::disk('local')->put(getUserOrganizationFilePath('images').'/'.$file_name, base64_decode($image));

        $user->signature = $file_name;
        $user->save();

        return response()->json(
            [
                'success' => true,
                'message' => 'Signature changed successfully',
            ],
            Response::HTTP_OK
        );
    }
}
