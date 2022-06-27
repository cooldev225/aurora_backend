<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\AnaestheticQuestion;
use App\Http\Requests\AnaestheticQuestionRequest;

class AnaestheticQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;

        $anaesthetic_questions = AnaestheticQuestion::where(
            'organization_id',
            $organization_id
        )->get();

        return response()->json(
            [
                'message' => 'Anaesthetic Question List',
                'data' => $anaesthetic_questions,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AnaestheticQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnaestheticQuestionRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $anaestheticQuestion = AnaestheticQuestion::create([
            'question' => $request->question,
            'organization_id' => $organization_id,
            'clinc_id' => $request->clinc_id,
        ]);

        return response()->json(
            [
                'message' => 'New Anaesthetic Question created',
                'data' => $anaestheticQuestion,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AnaestheticQuestionRequest  $request
     * @param  \App\Models\AnaestheticQuestion  $anaestheticQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(
        AnaestheticQuestionRequest $request,
        AnaestheticQuestion $anaestheticQuestion
    ) {
        $organization_id = auth()->user()->organization_id;

        $anaestheticQuestion->update([
            'question' => $request->question,
            'organization_id' => $organization_id,
            'clinc_id' => $request->clinc_id,
        ]);

        return response()->json(
            [
                'message' => 'Anaesthetic Question updated',
                'data' => $anaestheticQuestion,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnaestheticQuestion  $anaestheticQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnaestheticQuestion $anaestheticQuestion)
    {
        $anaestheticQuestion->delete();

        return response()->json(
            [
                'message' => 'Anaesthetic Question Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
