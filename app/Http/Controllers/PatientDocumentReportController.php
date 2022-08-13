<?php

namespace App\Http\Controllers;

use App\Models\PatientReport;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PatientDocumentReportController extends Controller
{
    public function destroy(PatientReport $patientReport)
    {
        $patientReport->delete();

        return response()->json(
            [
                'message' => 'Patient Report Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
