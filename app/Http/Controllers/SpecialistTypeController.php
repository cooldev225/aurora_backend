<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\SpecialistType;
use App\Http\Requests\SpecialistTypeRequest;

class SpecialistTypeController extends Controller
{
    /**
     * Display a listing of the Specialist Type resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialistTypes = SpecialistType::all()->toArray();

        return response()->json(
            [
                'message' => 'Specilaist Type List',
                'data' => $specialistTypes,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created Specialist Type resource in storage.
     *
     * @param  \App\Http\Requests\SpecialistTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialistTypeRequest $request)
    {
        $specialistType = SpecialistType::create([
            'name' => $request->name,
        ]);

        return response()->json(
            [
                'message' => 'New Specialist Type created',
                'data' => $specialistType,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified Specialist Type resource in storage.
     *
     * @param  \App\Http\Requests\SpecialistTypeRequest  $request
     * @param  \App\Models\SpecialistTypeRequest  $specialistType
     * @return \Illuminate\Http\Response
     */
    public function update(
        SpecialistTypeRequest $request,
        SpecialistType $specialistType
    ) {
        $specialistType->update([
            'name' => $request->name,
        ]);

        return response()->json(
            [
                'message' => 'Specialist Type updated',
                'data' => $specialistType,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified  Specialist Type resource from storage.
     *
     * @param  \App\Models\SpecialistType  $specialistType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialistType $specialistType)
    {
        $specialistType->delete();

        return response()->json(
            [
                'message' => 'Specialist Type successfully Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
