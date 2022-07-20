<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\LetterTemplate;
use App\Http\Requests\LetterTemplateRequest;

class LetterTemplateController extends BaseOrganizationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LetterTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LetterTemplateRequest $request)
    {
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
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LetterTemplateRequest  $request
     * @param  \App\Models\LetterTemplate  $letterTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(
        LetterTemplateRequest $request,
        LetterTemplate $letterTemplate
    ) {
        $organization_id = auth()->user()->organization_id;

        if ($letterTemplate->organization_id != $organization_id) {
            return $this->forbiddenOrganization();
        }

        $letterTemplate->update([
            ...$request->all(),
            'organization_id' => $organization_id,
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LetterTemplate  $letterTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(LetterTemplate $letterTemplate)
    {
        $letterTemplate->delete();

        return response()->json(
            [
                'message' => 'Letter Template Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
