<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class BaseOrganizationController extends Controller
{
    /**
     * Return Forbidden Response
     */
    protected function ForbiddenOrganization()
    {
        return response()->json(
            [
                'message' => 'Different Organization',
            ],
            Response::HTTP_FORBIDDEN
        );
    }
}
