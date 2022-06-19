<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * login user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'string|min:2|max:100',
            'email' => 'email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $auth_params = $validator->validated();
        $role_slug = '';

        if (empty($auth_params['email'])) {
            $user = User::where('username', $auth_params['username'])
                ->limit(1)
                ->get();

            if (empty($user->toArray())) {
                return response()->json(
                    ['error' => 'Unauthorized'],
                    Response::HTTP_UNAUTHORIZED
                );
            } else {
                $auth_params['email'] = $user[0]->email;
            }

            $role_slug = $user[0]->role()->slug;
        }

        if (!($token = auth()->attempt($validator->validated()))) {
            return response()->json(
                ['error' => 'Unauthorized'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return response()->json(
            [
                'email' => $auth_params['email'],
                'username' => $auth_params['username'],
                'role' => $role_slug,
                'access_token' => $token,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * verify_token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify_token(Request $request)
    {
        $user = auth()->user();
        $token = auth()->fromUser($user);
        $role_slug = auth()
            ->user()
            ->role()->slug;

        return response()->json(
            [
                'email' => $user->email,
                'username' => $user->username,
                'role' => $role_slug,
                'access_token' => $token,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out.']);
    }

    /**
     * Refresh token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get user profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
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