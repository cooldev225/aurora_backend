<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\SpecialistTitle;
use App\Http\Requests\SpecialistTitleRequest;

class SpecialistTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialistTitle = SpecialistTitle::all();

        return response()->json(
            [
                'message' => 'Specialist Title List',
                'data' => $specialistTitle,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SpecialistTitleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialistTitleRequest $request)
    {
        $specialistTitle = SpecialistTitle::create([
            'name' => $request->name,
        ]);

        return response()->json(
            [
                'message' => 'New Specialist Title created',
                'data' => $specialistTitle,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SpecialistTitleRequest  $request
     * @param  \App\Models\SpecialistTitle  $specialistTitle
     * @return \Illuminate\Http\Response
     */
    public function update(
        SpecialistTitleRequest $request,
        SpecialistTitle $specialistTitle
    ) {
        $specialistTitle->update([
            'name' => $request->name,
        ]);

        return response()->json(
            [
                'message' => 'Specialist Title updated',
                'data' => $specialistTitle,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecialistTitle  $specialistTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialistTitle $specialistTitle)
    {
        $specialistTitle->delete();

        return response()->json(
            [
                'message' => 'Specialist Title Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
