<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\LetterTemplate;
use App\Http\Requests\LetterTemplateRequest;

class LetterTemplateController extends Controller
{
    /**
     * [Letter Template] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAll', LetterTemplate::class);

        $organization_id = auth()->user()->organization_id;

        $letterTemplates = LetterTemplate::where(
            'organization_id',
            $organization_id
        )->get();

        return response()->json(
            [
                'message' => 'Letter Template List',
                'data' => $letterTemplates,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Letter Template] - Store
     *
     * @param  \App\Http\Requests\LetterTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LetterTemplateRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', LetterTemplate::class);

        $organization_id = auth()->user()->organization_id;

        $letterTemplate = LetterTemplate::create([
            ...$request->all(),
            'organization_id' => $organization_id,
        ]);

        return response()->json(
            [
                'message' => 'New Letter Template created',
                'data' => $letterTemplate,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Letter Template] - Update
     *
     * @param  \App\Http\Requests\LetterTemplateRequest  $request
     * @param  \App\Models\LetterTemplate  $letterTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(
        LetterTemplateRequest $request,
        LetterTemplate $letterTemplate
    ) {
        // Verify the user can access this function via policy
        $this->authorize('update', $letterTemplate);

        $letterTemplate->update([
            ...$request->all(),
            'organization_id' => auth()->user()->organization_id,
        ]);

        return response()->json(
            [
                'message' => 'Letter Template updated',
                'data' => $letterTemplate,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Letter Template] - Destroy
     *
     * @param  \App\Models\LetterTemplate  $letterTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(LetterTemplate $letterTemplate)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $letterTemplate);

        $letterTemplate->delete();

        return response()->json(
            [
                'message' => 'Letter Template Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
