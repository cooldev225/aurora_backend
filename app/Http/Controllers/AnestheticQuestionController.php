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
     * A list of all the organizations questions. These questions are used to asses the initial status of an appointments 'procedure_approval_status' 
     * @group Settings
     * @responseFile storage/responses/settings.anestheticQuestions.list.json
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;

        $anesthetic_questions = AnestheticQuestion::where(
            'organization_id',
            $organization_id
        );

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
     * @group Settings
     * @param  \App\Http\Requests\AnestheticQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnestheticQuestionRequest $request)
    {
        $anestheticQuestion = AnestheticQuestion::create([
            'organization_id'   => auth()->user()->organization_id,
            'question'          =>  $request->question,
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
     * @group Settings
     * @param  \App\Http\Requests\AnestheticQuestionRequest  $request
     * @param  \App\Models\AnestheticQuestion  $anestheticQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(
        AnestheticQuestionRequest $request,
        AnestheticQuestion $anestheticQuestion
    ) {
   
        $anestheticQuestion->update([
            'organization_id'   => auth()->user()->organization_id,
            'question'          =>  $request->question,
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
     * @group Settings
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
