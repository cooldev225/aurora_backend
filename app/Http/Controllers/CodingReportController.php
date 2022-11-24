<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Response;
use App\Http\Requests\CodingReportRequest;

class CodingReportController extends Controller
{

    /**
     * [CodingReport] - Store
     *
     * @param  \App\Http\Requests\CodingReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CodingReportRequest $request)
    {
        // Verify the user can access this function via policy

        

        return response()->json(
            [
                'message' => 'generate coding report',
                'data' => 'ok',
            ],
            Response::HTTP_CREATED
        );
    }
}
