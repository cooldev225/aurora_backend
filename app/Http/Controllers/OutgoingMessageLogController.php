<?php

namespace App\Http\Controllers;

use App\Http\Requests\OutgoingMessageLogIndexRequest;
use App\Models\OutgoingMessageLog;
use Illuminate\Http\Response;

class OutgoingMessageLogController extends Controller
{
    public function index(OutgoingMessageLogIndexRequest $request){
        $params = $request->validated();
        $users = OutgoingMessageLog::where('organization_id', auth()->user()->organization_id);

        foreach ($params as $column => $param) {
            if (!empty($param)) {
                $users = $users->where($column, '=', $param);
            }
        }
        
        $users = $users->with('patient');

        return response()->json(
            [
                'message' => 'Outgoing message log',
                'data' => $users->get(),
                'param' => $params,
            ],
            Response::HTTP_OK
        );
    }
}
