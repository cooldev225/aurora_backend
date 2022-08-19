<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\AnestheticAnswer;
use App\Http\Requests\AnestheticAnswerRequest;

class AnestheticAnswerController extends Controller
{
    /**
     * [Anesthetic Answer] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index($appointment_id, $question_id)
    {
        $anesthetic_answers = AnestheticAnswer::where(
            'appointment_id',
            $appointment_id
        )
            ->where('question_id', $question_id)
            ->get();

        return response()->json(
            [
                'message' => 'Anesthetic Answer List',
                'data' => $anesthetic_answers,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Anesthetic Answer] - Store
     *
     * @param  \App\Http\Requests\AnestheticAnswerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        AnestheticAnswerRequest $request,
        $appointment_id,
        $question_id
    ) {
        $anestheticAnswer = AnestheticAnswer::create([
            'answer' => $request->answer,
            'appointment_id' => $appointment_id,
            'question_id' => $question_id,
        ]);

        return response()->json(
            [
                'message' => 'New Anesthetic Answer created',
                'data' => $anestheticAnswer,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Anesthetic Answer] - Update
     *
     * @param  \App\Http\Requests\AnestheticAnswerRequest  $request
     * @param  \App\Models\AnestheticAnswer  $anestheticAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(
        AnestheticAnswerRequest $request,
        $appointment_id,
        $question_id,
        AnestheticAnswer $anestheticAnswer
    ) {
        $anestheticAnswer->update([
            'answer' => $request->answer,
            'appointment_id' => $appointment_id,
            'question_id' => $question_id,
        ]);

        return response()->json(
            [
                'message' => 'Anesthetic Answer updated',
                'data' => $anestheticAnswer,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Anesthetic Answer] - Destroy
     *
     * @param  \App\Models\AnestheticAnswer  $anestheticAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        $appointment_id,
        $question_id,
        AnestheticAnswer $anestheticAnswer
    ) {
        $anestheticAnswer->delete();

        return response()->json(
            [
                'message' => 'Anesthetic Answer Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
