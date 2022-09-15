<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\BirthCodeRequest;
use App\Models\BirthCode;

class BirthCodeController extends Controller
{
    /**
     * [Birth Code] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', BirthCode::class);

        $birthCodes = BirthCode::all();

        return response()->json(
            [
                'message' => 'Birthcode List',
                'data' => $birthCodes,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Birth Code] - Store
     *
     * @param  \App\Http\Requests\BirthCodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BirthCodeRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', BirthCode::class);

        $birthCode = BirthCode::create($request->validated());

        return response()->json(
            [
                'message' => 'New Birth Code created',
                'data' => $birthCode,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Birth Code] - Update
     *
     * @param  \App\Http\Requests\BirthCodeRequest  $request
     * @param  \App\Models\BirthCode  $birthCode
     * @return \Illuminate\Http\Response
     */
    public function update(BirthCodeRequest $request, BirthCode $birthCode)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $birthCode);

        $birthCode->update($request->validated());

        return response()->json(
            [
                'message' => 'Birth Code updated',
                'data' => $birthCode,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Birth Code] - Destroy
     *
     * @param  \App\Models\BirthCode  $birthCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(BirthCode $birthCode)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $birthCode);

        $birthCode->delete();

        return response()->json(
            [
                'message' => 'Brith Code Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
