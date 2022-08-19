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
     * [Birth Code] - Update
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
     * [Birth Code] - Destroy
     *
     * @param  \App\Models\BirthCode  $birthCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(BirthCode $birthCode)
    {
        $birthCode->delete();

        return response()->json(
            [
                'message' => 'Brith Code Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
