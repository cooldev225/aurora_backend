<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;
use App\Models\User;


class UserAuthenticationController extends Controller
{

/**
     * [Authentication] - User Login
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $auth_params = $request->validated();

        if (empty($auth_params['email'])) {
            $user = User::where('username', $auth_params['username'])->first();

            if (empty($user)) {
                return response()->json(
                    ['error' => 'Unauthorized'],
                    Response::HTTP_UNAUTHORIZED
                );
            } else {
                $auth_params['email'] = $user->email;
            }
        }

        if (!($token = auth()->attempt($request->validated()))) {
            return response()->json(
                ['error' => 'Unauthorized'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $user = auth()->user();

        return response()->json(
            [
                'email' => $user->email,
                'username' => $user->username,
                'role' => $user->role->slug,
                'access_token' => $token,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Authentication] - Verify Token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify_token()
    {
        $user = auth()->user();
        $token = auth()->fromUser($user);

        return response()->json(
            [
                'email' => $user->email,
                'username' => $user->username,
                'role' => $user->role->slug,
                'access_token' => $token,
                'profile' => auth()->user(),
                'organization' => auth()->user()->organization,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Authentication] - User Logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out.']);
    }

    /**
     * [Authentication] - Refresh Token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' =>
                auth()
                    ->factory()
                    ->getTTL() * 60,
        ]);
    }

}