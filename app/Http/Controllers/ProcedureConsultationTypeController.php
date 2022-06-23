<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\ProcedureConsultationType;
use App\Http\Requests\ProcedureConsultationTypeRequest;

class ProcedureConsultationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcedureConsultationTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureConsultationTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureConsultationType  $procedureConsultationType
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureConsultationType $procedureConsultationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcedureConsultationType  $procedureConsultationType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcedureConsultationType $procedureConsultationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProcedureConsultationTypeRequest  $request
     * @param  \App\Models\ProcedureConsultationType  $procedureConsultationType
     * @return \Illuminate\Http\Response
     */
    public function update(
        ProcedureConsultationTypeRequest $request,
        ProcedureConsultationType $procedureConsultationType
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureConsultationType  $procedureConsultationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        ProcedureConsultationType $procedureConsultationType
    ) {
        //
    }
}
