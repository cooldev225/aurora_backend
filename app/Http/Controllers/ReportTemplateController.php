<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\ReportTemplate;
use App\Http\Requests\ReportTemplateRequest;

class ReportTemplateController extends Controller
{
    /**
     * [Report Template] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', ReportTemplate::class);

        $organization_id = auth()->user()->organization_id;

        $report_template = ReportTemplate::where(
            'organization_id',
            $organization_id
        )
            ->with('sections')
            ->with('sections.autoTexts')
            ->get();

        return response()->json(
            [
                'message' => 'Report Template List',
                'data' => $report_template,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Report Template] - Store
     *
     * @param  \App\Http\Requests\ReportTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportTemplateRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', ReportTemplate::class);

        $report_template = ReportTemplate::createTemplate([
            'organization_id' => auth()->user()->organization_id,
            ...$request->validated(),
        ]);

        return response()->json(
            [
                'message' => 'New Report Template created',
                'data' => $report_template,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Report Template] - Update
     *
     * @param  \App\Http\Requests\ReportTemplateRequest  $request
     * @param  \App\Models\ReportTemplate  $report_template
     * @return \Illuminate\Http\Response
     */
    public function update(
        ReportTemplateRequest $request,
        ReportTemplate $report_template
    ) {
        // Verify the user can access this function via policy
        $this->authorize('update', $report_template);

        $report_template = $report_template->update([
            ...$request->validated(),
        ]);

        return response()->json(
            [
                'message' => 'Report Template updated',
                'data' => $report_template,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Report Template] - Destroy
     *
     * @param  \App\Models\ReportTemplate  $report_template
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportTemplate $report_template)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $report_template);

        $report_template->delete();

        return response()->json(
            [
                'message' => 'Report Template Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
