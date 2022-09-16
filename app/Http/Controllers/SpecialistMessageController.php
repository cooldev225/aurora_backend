<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\PatientDocument;
use Illuminate\Support\Facades\Log;

class SpecialistMessageController extends Controller
{

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return response()->json(
            [
                'message' => 'Appointment List',
                'data'    => PatientDocument::where('specialist_id', auth()->user()->id)->get(),
            ],
            Response::HTTP_OK
        );
    }
}
