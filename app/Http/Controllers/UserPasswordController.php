<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserPasswordController extends Controller
{


    /**
     * [User] - Update Password
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordUpdateRequest $request)
    {
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => [
                        'old_password' => 'Old password didn\'t match.',
                    ],
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $user = auth()->user();

        // Verify the user can access this function via policy
        $this->authorize('updateProfile', $user);

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Password changed successfully',
            ],
            Response::HTTP_OK
        );
    }
}