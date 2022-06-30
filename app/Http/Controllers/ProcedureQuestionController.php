<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\ProcedureQuestion;
use App\Http\Requests\ProcedureQuestionRequest;

class ProcedureQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;

        $procedure_questions = ProcedureQuestion::where(
            'organization_id',
            $organization_id
        )->get();

        return response()->json(
            [
                'message' => 'Procedure Question List',
                'data' => $procedure_questions,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Get a listing of active questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function activeQuestions()
    {
        $organization_id = auth()->user()->organization_id;

        $procedure_questions = ProcedureQuestion::where(
            'organization_id',
            $organization_id
        )
            ->where('status', 'enabled')
            ->get();

        return response()->json(
            [
                'message' => 'Active Procedure Question List',
                'data' => $procedure_questions,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProcedureQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcedureQuestionRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $procedureQuestion = ProcedureQuestion::create([
            'question' => $request->question,
            'organization_id' => $organization_id,
            'status' => $request->status,
        ]);

        return response()->json(
            [
                'message' => 'New Procedure Question created',
                'data' => $procedureQuestion,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProcedureQuestionRequest  $request
     * @param  \App\Models\ProcedureQuestion  $procedureQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(
        ProcedureQuestionRequest $request,
        ProcedureQuestion $procedureQuestion
    ) {
        $organization_id = auth()->user()->organization_id;

        $procedureQuestion->update([
            'question' => $request->question,
            'organization_id' => $organization_id,
            'status' => $request->status,
        ]);

        return response()->json(
            [
                'message' => 'Procedure Question updated',
                'data' => $procedureQuestion,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureQuestion  $procedureQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureQuestion $procedureQuestion)
    {
        $procedureQuestion->delete();

        return response()->json(
            [
                'message' => 'Procedure Question Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
