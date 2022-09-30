<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignatureUpdateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Enum\FileType;
use Illuminate\Support\Facades\Storage;

class UserProfileSignatureController extends Controller
{


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
        $image = str_replace('data:image/png;base64,', '', $params['signature']);
        $image = str_replace(' ', '+', $image);
        Storage::disk('local')->put(getUserProfileSignatureFilePath().'/'.$file_name, base64_decode($image));

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
