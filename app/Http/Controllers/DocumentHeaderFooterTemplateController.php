<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use Illuminate\Http\Response;
use App\Models\DocumentHeaderFooterTemplate;
use App\Http\Requests\DocumentHeaderFooterTemplateRequest;
use Illuminate\Http\Request;

class DocumentHeaderFooterTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', DocumentHeaderFooterTemplate::class);

        $organization_id = auth()->user()->organization_id;

        $templates = DocumentHeaderFooterTemplate::where(
            'organization_id',
            $organization_id
        )->get();

        return response()->json(
            [
                'message' => 'Letter Template List',
                'data' => $templates,
            ],
            Response::HTTP_OK
        );
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DocumentHeaderFooterTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentHeaderFooterTemplateRequest $request)
    {
        $organization = auth()->user()->organization_id;


        $header = "";
        if ($file = $request->file('document_header')) {
            $file_name = generateFileName(FileType::DOCUMENT_HEADER, $organization->id, $file->extension());
            $header = $file_name;
        }

        $footer = "";
        if ($file = $request->file('document_footer')) {
            $file_name = generateFileName(FileType::DOCUMENT_FOOTER, $organization->id, $file->extension());
            $footer = $file_name;
        }

        DocumentHeaderFooterTemplate::create([
            'organization_id' => $organization->id(),
            'header_file'     => $header,
            'footer_file'     => $footer,
            'user_id'         => $request->user_id ? $request->user_id : null,
        ]);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentHeaderFooterTemplate  $documentHeaderFooterTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentHeaderFooterTemplate $documentHeaderFooterTemplate)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DocumentHeaderFooterTemplateRequest  $request
     * @param  \App\Models\DocumentHeaderFooterTemplate  $documentHeaderFooterTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentHeaderFooterTemplateRequest $request, DocumentHeaderFooterTemplate $documentHeaderFooterTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentHeaderFooterTemplate  $documentHeaderFooterTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentHeaderFooterTemplate $documentHeaderFooterTemplate)
    {
        //
    }
}
