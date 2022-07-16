<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\ReportTemplate;
use App\Http\Requests\ReportTemplateRequest;

class ReportTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;

        $report_template = ReportTemplate::where('organization_id', $organization_id)
            ->with('sections')
            ->with('sections.autotexts')
            ->get();

        return response()->json(
            [
                'message'   => 'Report Template List',
                'data'      => $report_template,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReportTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportTemplateRequest $request)
    {
        $organization_id = auth()->user()->organization_id;

        $report_template = ReportTemplate::create([
            'title'             => $request->title,
            'organization_id'   => $organization_id,
        ]);

        return response()->json(
            [
                'message'   => 'New Report Template created',
                'data'      => $report_template,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ReportTemplateRequest  $request
     * @param  \App\Models\ReportTemplate  $report_template
     * @return \Illuminate\Http\Response
     */
    public function update(ReportTemplateRequest $request, ReportTemplate $report_template)
    {
        $organization_id = auth()->user()->organization_id;

        $report_template->update([
            'title'             => $request->title,
            'organization_id'   => $organization_id,
        ]);

        return response()->json(
            [
                'message'   => 'ReportTemplate updated',
                'data'      => $report_template,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportTemplate  $report_template
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportTemplate $report_template)
    {
        $report_template->delete();

        return response()->json(
            [
                'message'   => 'ReportTemplate Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
