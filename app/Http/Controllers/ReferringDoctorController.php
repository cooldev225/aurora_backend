<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\ReferringDoctor;
use App\Http\Requests\ReferringDoctorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferringDoctorController extends BaseOrganizationController
{
    /**
     * [Referring Doctor] - All
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referringDoctors = ReferringDoctor::all();

        return response()->json(
            [
                'message'   => 'Referring Doctor List',
                'data'      => $referringDoctors,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Referring Doctor] - list
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $referringDoctors = ReferringDoctor::select(
            'id',
            DB::raw('CONCAT(title, " ", first_name, " ", last_name) AS full_name'),
            'title',
            'first_name',
            'last_name',
            'email',
            'address'
        )->get();

        return response()->json(
            [
                'message'   => 'Referring Doctor List',
                'data'      => $referringDoctors,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Search the Referring Doctor by filters
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $term = $request->term;

        if (trim($term) == '') {
            return response()->json(
                [
                    'data'  => [],
                ],
                Response::HTTP_OK
            );
        }

        $keyword = '%' . $term . '%';

        $arrReferringDoctors = ReferringDoctor::whereRaw(
                'CONCAT(`first_name`, \' \', `last_name`) LIKE "' . $keyword . '"')
            ->orWhere('address', 'LIKE', $keyword)
            ->orWhere('provider_no', 'LIKE', $keyword)
            ->limit(10)
            ->get();

        $result = [];
        foreach ($arrReferringDoctors as $doctor) {
            $info = '<i class="fa  fa-user-md"></i> ' . $doctor->title . ' '
                . $doctor->first_name . ' ' . $doctor->last_name
                . '<br /><i class="fa fa-map-marker"></i> ' . $doctor->address
                . '<br /><i class="fa fa-hand-o-right"></i> ' . $doctor->provider_no
                . '<br /><i class="fa fa-phone"></i> ' . $doctor->country_extension
                . ' ' . $doctor->mobile;

            $result[] =  [
                'id'    =>  $doctor->id,
                'text'  =>  $info
            ];
        }

        return response()->json(
            [
                'data'  => $result,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReferringDoctorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReferringDoctorRequest $request)
    {
        $referringDoctor = ReferringDoctor::create([
            ...$request->all()
        ]);

        return response()->json(
            [
                'message' => 'New Referring Doctor created',
                'data' => $referringDoctor,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ReferringDoctorRequest  $request
     * @param  \App\Models\ReferringDoctor  $referringDoctor
     * @return \Illuminate\Http\Response
     */
    public function update(
        ReferringDoctorRequest $request,
        ReferringDoctor $referringDoctor
    ) {
        $referringDoctor->update([
            ...$request->all()
        ]);

        return response()->json(
            [
                'message' => 'Referring Doctor updated',
                'data' => $referringDoctor,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReferringDoctor  $referringDoctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReferringDoctor $referringDoctor)
    {
        $referringDoctor->delete();

        return response()->json(
            [
                'message' => 'Referring Doctor Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
