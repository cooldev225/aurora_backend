<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;

class SpecialistController extends Controller
{
    /**
     * [Specialist] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization = auth()->user()->organization;
        $specialists = $organization
                ->users
                ->where('role_id', 5)
                ->all();


        return response()->json(
            [
                'message' => 'Specialist List',
                'data' => $specialists
            ],
            Response::HTTP_OK
        );
    }
}
