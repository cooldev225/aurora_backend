<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\BirthCodeRequest;
use App\Models\BirthCode;

class BrithCodeController extends Controller
{
    /**
     * Display a listing of the Birth Code resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $birthCodes = BirthCode::all()->toArray();

        return response()->json(
            [
                'message' => 'Birthcode List',
                'data' => $birthCodes,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created Birth Code resource in storage.
     *
     * @param  \App\Http\Requests\BirthCodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BirthCodeRequest $request)
    {
        $birthCode = BirthCode::create([
            'code' => $request->code,
            'description' => $request->description,
        ]);

        return response()->json(
            [
                'message' => 'New Birth Code created',
                'data' => $birthCode,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified birthcode resource in storage.
     *
     * @param  \App\Http\Requests\BirthCodeRequest  $request
     * @param  \App\Models\BirthCode  $birthCode
     * @return \Illuminate\Http\Response
     */
    public function update(BirthCodeRequest $request, BirthCode $birthCode)
    {
        $birthCode->update([
            'code' => $request->code,
            'description' => $request->description,
        ]);

        return response()->json(
            [
                'message' => 'Birth Code updated',
                'data' => $birthCode,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified Birth Code resource from storage.
     *
     * @param  \App\Models\BirthCode  $birthCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(BirthCode $birthCode)
    {
        $birthCode->delete();

        return response()->json(
            [
                'message' => 'Brith Code successfully Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
