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
        )
        //->with('organization')
        //->with('getfooterfile')
        ->get();

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
        // Verify the user can access this function via policy
        $this->authorize('create', DocumentHeaderFooterTemplate::class);

        $organization_id = auth()->user()->organization_id;

        $header = "";
        if ($file = $request->file('header_file')) {
            $file_name = generateFileName(FileType::DOCUMENT_HEADER, $organization_id, $file->extension());
            $filepath = getUserOrganizationFilePath();
            $file->storeAs($filepath, $file_name);
            $header = $file_name;
        }

        $footer = "";
        if ($file = $request->file('footer_file')) {
            $file_name = generateFileName(FileType::DOCUMENT_FOOTER, $organization_id, $file->extension());
            $filepath = getUserOrganizationFilePath();
            $file->storeAs($filepath, $file_name);
            $footer = $file_name;
        }

        $documentHeaderFooterTemplate = DocumentHeaderFooterTemplate::create([
            'title'           => $request->title,
            'organization_id' => $organization_id,
            'header_file'     => $header,
            'footer_file'     => $footer,
            'user_id'         => $request->user_id ? $request->user_id : null,
        ]);

        return response()->json(
            [
                'message' => 'New Document Header/Footer Template created',
                'data' => $documentHeaderFooterTemplate,
            ],
            Response::HTTP_CREATED
        );
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
