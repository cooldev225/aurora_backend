<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Requests\UserAuthorizationPinRequest;

class UserAuthorizationPinController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user();

        return response()->json(
            [
                'pin' => $user->authorization_pin,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function set(UserAuthorizationPinRequest $request)
    {
        $user = auth()->user();

        $user->authorization_pin = $request->pin;
        $user->save();

        return response()->json(
            [
                'message' => 'User pin set',
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify(UserAuthorizationPinRequest $request)
    {
        $user = auth()->user();

        $admins = User::whereRoleId(UserRole::ORGANIZATION_ADMIN)
                      ->whereOrganizationId($user->organization_id)
                      ->whereNotNull('authorization_pin')
                      ->get();

        $pin_valid = false;
        $confirming_user = null;

        foreach ($admins as $admin) {
            if ($admin->authorization_pin == $request->pin) {
                $pin_valid = true;
                $confirming_user = $admin;
                break;
            }
        }

        if ($pin_valid) {
            return response()->json(
                [
                    'verified'        => true,
                    'confirming_user' => $confirming_user->id,
                ],
                Response::HTTP_OK
            );
        }

        return response()->json(
            [
                'verified' => false,
                'message'  => 'The pin provided is invalid'
            ],
            Response::HTTP_UNAUTHORIZED
        );
    }
}
