<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\AnestheticQuestion;
use App\Http\Requests\AnestheticQuestionRequest;

class AnestheticQuestionController extends Controller
{
    /**
     * [Anesthetic Question] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $organization_id = auth()->user()->organization_id;

        $anesthetic_questions = AnestheticQuestion::where(
            'organization_id',
            $organization_id
        );

        if ($request->has('status')) {
            $anesthetic_questions->where('status', $request->status);
        }

        $anesthetic_questions = $anesthetic_questions->get();

        return response()->json(
            [
                'message' => 'Anesthetic Question List',
                'data' => $anesthetic_questions,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Anesthetic Question] - Store
     *
     * @param  \App\Http\Requests\AnestheticQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnestheticQuestionRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $anestheticQuestion = AnestheticQuestion::create([
            ...$request->all(),
            'organization_id' => $organization_id,
        ]);

        return response()->json(
            [
                'message' => 'New Anesthetic Question created',
                'data' => $anestheticQuestion,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Anesthetic Question] - Update
     *
     * @param  \App\Http\Requests\AnestheticQuestionRequest  $request
     * @param  \App\Models\AnestheticQuestion  $anestheticQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(
        AnestheticQuestionRequest $request,
        AnestheticQuestion $anestheticQuestion
    ) {
        $organization_id = auth()->user()->organization_id;

        $anestheticQuestion->update([
            ...$request->all(),
            'organization_id' => $organization_id,
        ]);

        return response()->json(
            [
                'message' => 'Anesthetic Question updated',
                'data' => $anestheticQuestion,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Anesthetic Question] - Destroy
     *
     * @param  \App\Models\AnestheticQuestion  $anestheticQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnestheticQuestion $anestheticQuestion)
    {
        $anestheticQuestion->delete();

        return response()->json(
            [
                'message' => 'Anesthetic Question Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
