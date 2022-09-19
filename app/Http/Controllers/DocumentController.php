<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentIndexRequest;
use App\Models\PatientDocument;
use Illuminate\Http\Response;


class DocumentController extends Controller
{

    /**
     * Retrieves all documents without giver filters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DocumentIndexRequest $request)
    {

        $params = $request->validated();
        $documents = PatientDocument::where('organization_id', auth()->user()->organization_id);

        foreach ($params as $column => $param) {
            if (!empty($param)) {
                if($param == 'before_date'){
                    $documents = $documents->where('created_at', '<=', $param);
                }else if ($param == 'after_date'){
                    $documents = $documents->where('created_at', '>=', $param);
                }else{
                    $documents = $documents->where($column, $param);
                } 
            }
        }

        return response()->json(
            [
                'message' => 'Document List',
                'data'    => $documents->get(),
            ],
            Response::HTTP_OK
        );
    }
}
