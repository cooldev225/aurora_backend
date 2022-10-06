<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialistIndexRequest;
use Illuminate\Http\Response;
use App\Http\Requests\PatientRequest;
use App\Models\Appointment;
use App\Models\Organization;
use App\Models\User;
use App\Enum\UserRole;

class SpecialistController extends Controller
{
    /**
     * [Patient] - List
     *
     * Returns a lists of all patients
     *
     * @group Patients
     * @responseFile storage/responses/patients.show.json
     */
    public function index(SpecialistIndexRequest $request)
    {
        // Verify the user can access this function via policy
        // $this->authorize('viewAny', User::class);

        $params = $request->validated();

        $specialists = User::where('role_id', UserRole::SPECIALIST);

        foreach ($params as $column => $param) {
            if (!empty($param)) {
                $specialists = $specialists->where($column, '=', $param);
            }
        }

        $specialists = $specialists->get()->toArray();

        return response()->json(
            [
                'message' => 'Specialist List',
                'data' => $specialists,
            ],
            Response::HTTP_OK
        );
    }
}
