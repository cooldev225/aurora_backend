<?php

namespace App\Http\Controllers;

use App\Http\Requests\OutgoingMessageLogIndexIndexRequest;
use App\Models\OutgoingMessageLog;
use Illuminate\Http\Response;

class OutgoingMessageLogController extends Controller
{
    public function index(OutgoingMessageLogIndexIndexRequest $request){
        $params = $request->validated();

        $users = OutgoingMessageLog::where('organization_id', auth()->user()->organization_id);

        foreach ($params as $column => $param) {
            if (!empty($param)) {
                $users = $users->where($column, '=', $param);
            }
        }

        return response()->json(
            [
                'message' => 'Outgoing message log',
                'data' => $users->get(),
            ],
            Response::HTTP_OK
        );
    }
}
