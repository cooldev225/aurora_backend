<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodingIndexRequest;
use App\Models\Appointment;
use Illuminate\Http\Response;


class CodingController extends Controller
{
    /**
     * [Admin User] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CodingIndexRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', Appointment::class);

        $appointments = Appointment::where('organization_id', auth()->user()->organization_id)
            ->whereHas(
                'appointment_type',
                function ($query) {
                    $query->where('type',  'PROCEDURE');
                }
            )
            ->whereHas(
                'documents',
                function ($query) {
                    $query->where('document_type', 'REPORT');
                }
            )
            ->with('codes')
            ->with([
                'documents' => function ($query) {
                    $query->where('document_type', 'REPORT');
                }
            ]);

        if ($request->is_complete) {
            $appointments::where('is_complete', $request->is_complete);
        }

        return response()->json(
            [
                'message' => 'Admin List',
                'data' => $appointments->get(),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Admin User] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', Appointment::class);

        $appointments = Appointment::where('organization_id', auth()->user()->organization_id)->with('codes')->get();

        return response()->json(
            [
                'message' => 'Admin List',
                'data' => $appointments,
            ],
            Response::HTTP_OK
        );
    }
}
