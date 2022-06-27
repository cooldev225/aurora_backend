<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\AnaestheticAnswer;
use App\Http\Requests\AnaestheticAnswerRequest;

class AnaestheticAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($appointment_id, $question_id)
    {
        $anaesthetic_answers = AnaestheticAnswer::where(
            'appointment_id',
            $appointment_id
        )
            ->where('question_id', $question_id)
            ->get();

        return response()->json(
            [
                'message' => 'Anaesthetic Answer List',
                'data' => $anaesthetic_answers,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AnaestheticAnswerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        AnaestheticAnswerRequest $request,
        $appointment_id,
        $question_id
    ) {
        $anaestheticAnswer = AnaestheticAnswer::create([
            'answer' => $request->answer,
            'appointment_id' => $appointment_id,
            'question_id' => $question_id,
        ]);

        return response()->json(
            [
                'message' => 'New Anaesthetic Answer created',
                'data' => $anaestheticAnswer,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AnaestheticAnswerRequest  $request
     * @param  \App\Models\AnaestheticAnswer  $anaestheticAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(
        AnaestheticAnswerRequest $request,
        $appointment_id,
        $question_id,
        AnaestheticAnswer $anaestheticAnswer
    ) {
        $anaestheticAnswer->update([
            'answer' => $request->answer,
            'appointment_id' => $appointment_id,
            'question_id' => $question_id,
        ]);

        return response()->json(
            [
                'message' => 'Anaesthetic Answer updated',
                'data' => $anaestheticAnswer,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnaestheticAnswer  $anaestheticAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        $appointment_id,
        $question_id,
        AnaestheticAnswer $anaestheticAnswer
    ) {
        $anaestheticAnswer->delete();

        return response()->json(
            [
                'message' => 'Anaesthetic Answer Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
