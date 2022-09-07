<?php

namespace App\Http\Controllers;

use App\Models\HRMUserBaseSchedule;
use Illuminate\Http\Request;

class HRMUserBaseScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', HRMUserBaseSchedule::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Verify the user can access this function via policy
        $this->authorize('create', HRMUserBaseSchedule::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', HRMUserBaseSchedule::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HRMUserBaseSchedule  $hRMUserBaseSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(HRMUserBaseSchedule $hRMUserBaseSchedule)
    {
        // Verify the user can access this function via policy
        $this->authorize('view', $hRMUserBaseSchedule);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HRMUserBaseSchedule  $hRMUserBaseSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(HRMUserBaseSchedule $hRMUserBaseSchedule)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $hRMUserBaseSchedule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HRMUserBaseSchedule  $hRMUserBaseSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HRMUserBaseSchedule $hRMUserBaseSchedule)
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $hRMUserBaseSchedule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HRMUserBaseSchedule  $hRMUserBaseSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(HRMUserBaseSchedule $hRMUserBaseSchedule)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $hRMUserBaseSchedule);
    }
}
