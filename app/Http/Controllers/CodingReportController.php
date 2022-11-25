<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Response;
use App\Http\Requests\CodingReportRequest;
use Illuminate\Http\File;

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

        $content = "{$request->type}-{$request->from_date}-{$request->to_date}\n";
        $content .= "Report Date: {$request->from_date}-{$request->to_date}\n";
        $content .= "Report Type:: {$request->type}\n";
        $fileName = "{$request->type}-{$request->from_date}-{$request->to_date}.txt";
        $headers = [
            'Content-type' => 'text/plain', 
            'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
        ];
        File::put($fileName,$content);

        return response($fileName, Response::HTTP_OK)->header('Content-Type', 'text/plain');
    }
}
