<?php

namespace App\Http\Controllers;

use App\Models\ProvaDevice;
use App\Http\Requests\ProvaDeviceRequest;

class ProvaDeviceController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProvaDeviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvaDeviceRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProvaDevice  $provaDevice
     * @return \Illuminate\Http\Response
     */
    public function edit(ProvaDevice $provaDevice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProvaDeviceRequest  $request
     * @param  \App\Models\ProvaDevice  $provaDevice
     * @return \Illuminate\Http\Response
     */
    public function update(
        ProvaDeviceRequest $request,
        ProvaDevice $provaDevice
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProvaDevice  $provaDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProvaDevice $provaDevice)
    {
        //
    }
}
