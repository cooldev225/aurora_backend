<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentHeaderFooterTemplate;
use App\Http\Requests\DocumentHeaderFooterTemplateRequest;

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
        // $this->authorize('viewAny', DocumentHeaderFooterTemplate::class);

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
                'message' => 'Document Header/Footer Template List',
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
        $action = 'create';
        $documentHeaderFooterTemplate = null;
        $organization_id = auth()->user()->organization_id;

        // Verify the user can access this function via policy
        if(!$request->id){
            $this->authorize($action, DocumentHeaderFooterTemplate::class);

            $documentHeaderFooterTemplate = DocumentHeaderFooterTemplate::create([
                'title'           => $request->title,
                'organization_id' => $organization_id,
                'header_file'     => 'null',
                'footer_file'     => 'null',
                'user_id'         => $request->user_id ? $request->user_id : null,
            ]);
        }else{
            $action = 'update';
            $documentHeaderFooterTemplate = DocumentHeaderFooterTemplate::find($request->id);

            $this->authorize($action, $documentHeaderFooterTemplate);

            $documentHeaderFooterTemplate->title = $request->title;
            $documentHeaderFooterTemplate->save();
        }

        $header = "";
        if ($file = $request->file('header_file')) {
            $file_name = generateFileName(
                FileType::DOCUMENT_HEADER,
                $organization_id . "_" . $documentHeaderFooterTemplate->id,
                $file->extension()
            );
            $org_path = getUserOrganizationFilePath();
            
            if (!$org_path) {
                return response()->json(
                    [
                        'message'   => 'Could not find user organization',
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
            
            $file_path = "/{$org_path}/{$file_name}";
            $path = Storage::put($file_path, file_get_contents($file));

            $documentHeaderFooterTemplate->header_file = $file_path;
            $documentHeaderFooterTemplate->save();
        }

        $footer = "";
        if ($file = $request->file('footer_file')) {
            $file_name = generateFileName(
                FileType::DOCUMENT_FOOTER,
                $organization_id . "_" . $documentHeaderFooterTemplate->id,
                $file->extension()
            );
            $org_path = getUserOrganizationFilePath();
            
            if (!$org_path) {
                return response()->json(
                    [
                        'message'   => 'Could not find user organization',
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
            
            $file_path = "/{$org_path}/{$file_name}";
            $path = Storage::put($file_path, file_get_contents($file));

            $documentHeaderFooterTemplate->footer_file = $file_path;
            $documentHeaderFooterTemplate->save();
        }

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
        // Verify the user can access this function via policy
        $this->authorize('update', $documentHeaderFooterTemplate);

        $organization_id = auth()->user()->organization_id;

        $documentHeaderFooterTemplate = $documentHeaderFooterTemplate->update([
            'organization_id' => $organization_id,
            ...$request->validated(),
        ]);

        return response()->json(
            [
                'message' => 'Document Header/Footer Template updated',
                'data' => $documentHeaderFooterTemplate,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentHeaderFooterTemplate  $documentHeaderFooterTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentHeaderFooterTemplate $documentHeaderFooterTemplate)
    {
        $this->authorize('delete', $documentHeaderFooterTemplate);

        $documentHeaderFooterTemplate->delete();

        return response()->json(
            [
                'message' => 'Document Header/Footer Template Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
