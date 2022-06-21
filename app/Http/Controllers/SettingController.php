<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Instantiate a new AdminController instance.
     */
    public function __construct()
    {
        $this->organization_id = auth()->user()->organization_id;

        $this->is_admin = auth()
            ->user()
            ->isAdmin();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = [];

        if ($this->is_admin) {
            $settings = Setting::all();
        } else {
            $settings = Setting::where(
                'organization_id',
                $this->organization_id
            )->get();
        }

        return response()->json(
            [
                'message' => 'Setting List',
                'data' => $settings,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        $setting = Setting::create([
            'organization_id' => $this->organization_id,
            'apt_start_time_slot' => $request->apt_start_time_slot,
            'apt_end_time_slot' => $request->apt_end_time_slot,
            'total_time_diff' => $request->total_time_diff,
            'instructions' => $request->instructions,
            'notes' => $request->notes,
            'type' => $request->type,
        ]);

        return response()->json(
            [
                'message' => 'Setting created',
                'data' => $setting,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingRequest  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        $setting->Setting([
            'organization_id' => $this->organization_id,
            'apt_start_time_slot' => $request->apt_start_time_slot,
            'apt_end_time_slot' => $request->apt_end_time_slot,
            'total_time_diff' => $request->total_time_diff,
            'instructions' => $request->instructions,
            'notes' => $request->notes,
            'type' => $request->type,
        ]);

        return response()->json(
            [
                'message' => 'Setting updated',
                'data' => $setting,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return response()->json(
            [
                'message' => 'Setting Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
