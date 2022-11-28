<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Response;
use App\Http\Requests\CodingReportRequest;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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

        $formated_from_date = Carbon::parse($request->from_date)->format('d/m/Y');
        $formated_to_date = Carbon::parse($request->to_date)->format('d/m/Y');
        $content = "{$request->type}-{$formated_from_date}-{$formated_to_date}\n";
        $content .= "Report Date: {$formated_from_date}-{$formated_to_date}\n";
        $content .= "Report Type: {$request->type}\n";
        $fileName = "{$request->type}-".
                    Carbon::parse($request->from_date)->format('Y_m_d')."-".
                    Carbon::parse($request->to_date)->format('Y_m_d');
        $filePath = "files/".auth()->user()->organization_id . "/coding_reports//";
                    Storage::disk('local')->put($filePath.$fileName, $content);
        return response()->download(storage_path("app/".$filePath.$fileName));
    }
}
