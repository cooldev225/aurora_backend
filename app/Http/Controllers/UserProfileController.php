<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;

class UserProfileController extends Controller
{


    /**
     * [User] - User Profile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        return response()->json(
            $this->withBaseUrlForSingleUser(auth()->user())
        );
    }

    /**
     * [User] - Update User Profile
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = auth()->user();

        // Verify the user can access this function via policy
        $this->authorize('updateProfile', $user);

        $user->update($request->safe()->except(['photo']));

        if ($file = $request->file('photo')) {
            $file_name = generateFileName(FileType::USER_PHOTO, $user->id, $file->extension());
            $org_path = getUserOrganizationFilePath('images');
            
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

            $user->photo = Storage::url($path) . $file_name;
            $user->save();
        }

        return response()->json(
            [
                'message' => 'User Profile updated',
                'data' => $user,
            ],
            Response::HTTP_OK
        );
    }

        /**
     * Change avatar path to url
     */
    protected function withBaseUrlForSingleUser($user)
    {
        $base_url = url('/');

        $user = $user->toArray();

        if (substr($user['photo'], 0, 1) == '/') {
            $user['photo'] = $base_url . $user['photo'];
        }

        return $user;
    }

}