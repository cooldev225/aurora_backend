<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Mail\NewEmployee;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{


    /**
     * [User] - User Profile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
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
            $file_name =
                'photo_' . $user->id . '_' . time() . '.' . $file->extension();
            $photo_path = '/' . $file->storeAs('images/user', $file_name);
            $user->photo = $photo_path;
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

}