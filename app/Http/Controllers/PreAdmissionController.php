<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\PreAdmissionConsentRequest;
use App\Http\Requests\PreAdmissionSectionRequest;
use App\Models\PreAdmissionConsent;
use App\Models\PreAdmissionSection;
use Illuminate\Http\Response;

class PreAdmissionController extends Controller
{
    /**
     * [Pre Admission] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', PreAdmissionSection::class);

        $organization_id = auth()->user()->organization_id;

        $pre_admission_section = PreAdmissionSection::where(
            'organization_id',
            $organization_id
        )
            ->with('questions')
            ->get();

        return response()->json(
            [
                'message' => 'Pre Admission Section List',
                'data' => $pre_admission_section,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Pre Admission] - Store
     *
     * @param  \App\Http\Requests\PreAdmissionSectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PreAdmissionSectionRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', PreAdmissionSection::class);

        $organization_id = auth()->user()->organization_id;

        $pre_admission_section_list = PreAdmissionSection::where(
            'organization_id',
            $organization_id
        )
            ->with('questions')
            ->get();
        foreach($pre_admission_section_list as $pre_admission_section){
            $is_updated = false;
            for($i=0;$i<count($request->sections);$i++){
                if($pre_admission_section->id === $request->sections[$i]['id']){
                    $this->authorize('update', $pre_admission_section);
                    
                    $pre_admission_section->update([
                        'organization_id' => $organization_id,
                        'title' => $request->sections[$i]['title'],
                        'questions' => $request->sections[$i]['questions'],
                    ]);
                    //$this->update($pre_admission_section);
                    $is_updated = true;
                    break;
                }
            }
            if(!$is_updated){
                $this->destroy($pre_admission_section);
            }
        }
            
        foreach($request->sections as $pre_admission_section){
            if(!isset($pre_admission_section['id'])){
                //$this->authorize('create', $pre_admission_section);

                PreAdmissionSection::createSection([
                    'organization_id' => $organization_id,
                    'title' => $pre_admission_section['title'],
                    'questions' => $pre_admission_section['questions'],
                ]);
                //$this->create($sectionObj);
            }
        }

        $pre_admission_section = PreAdmissionSection::where(
            'organization_id',
            $organization_id
        )
            ->with('questions')
            ->get();

        return response()->json(
            [
                'message' => 'Pre Admission Section List',
                'data' => $pre_admission_section,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Pre Admission] - Create
     *
     * @param  \App\Models\PreAdmissionSection  $pre_admission_section
     * @return \Illuminate\Http\Response
     */
    public function create(
        PreAdmissionSection $pre_admission_section
    ) {
        // Verify the user can access this function via policy
        $this->authorize('create', $pre_admission_section);

        $organization_id = auth()->user()->organization_id;

        $pre_admission_section = PreAdmissionSection::createSection([
            'organization_id' => $organization_id,
            'title' => $pre_admission_section->title,
            'questions' => $pre_admission_section->questions,
        ]);

        return response()->json(
            [
                'message' => 'Pre Admission Section updated',
                'data' => $pre_admission_section,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Pre Admission] - Update
     *
     * @param  \App\Http\Requests\PreAdmissionSectionRequest  $request
     * @param  \App\Models\PreAdmissionSection  $pre_admission_section
     * @return \Illuminate\Http\Response
     */
    public function update(
        PreAdmissionSectionRequest $request,
        PreAdmissionSection $pre_admission_section
    ) {
        // Verify the user can access this function via policy
        $this->authorize('update', $pre_admission_section);

        $organization_id = auth()->user()->organization_id;

        $pre_admission_section = $pre_admission_section->update([
            'organization_id' => $organization_id,
            'title' => $request->title,
            'questions' => $request->questions,
        ]);

        return response()->json(
            [
                'message' => 'Pre Admission Section updated',
                'data' => $pre_admission_section,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Pre Admission] - Destroy
     *
     * @param  \App\Models\PreAdmissionSection  $pre_admission_section
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreAdmissionSection $pre_admission_section)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $pre_admission_section);

        $pre_admission_section->delete();

        return response()->json(
            [
                'message' => 'Pre Admission Section Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * [Pre Admission] - Update Consent
     *
     * @param  \App\Models\PreAdmissionSection  $pre_admission_section
     * @return \Illuminate\Http\Response
     */
    public function updateConsent(PreAdmissionConsentRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', PreAdmissionConsent::class);

        $organization_id = auth()->user()->organization_id;

        $pre_admission_consent = PreAdmissionConsent::where(
            'organization_id',
            $organization_id
        )->firstOrCreate();

        // Verify the user can access this function via policy
        $this->authorize('update', $pre_admission_consent);

        $pre_admission_consent->update([
            'organization_id' => $organization_id,
            'text' => $request->text,
        ]);

        return response()->json(
            [
                'message' => 'Pre Admission Consent updated',
                'data' => $pre_admission_consent,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Pre Admission] - Get Consent
     *
     * @param  \App\Models\PreAdmissionSection  $pre_admission_section
     * @return \Illuminate\Http\Response
     */
    public function getConsent()
    {
        $organization_id = auth()->user()->organization_id;

        $pre_admission_consent = PreAdmissionConsent::where(
            'organization_id',
            $organization_id
        )->firstOrCreate();
        
        // Verify the user can access this function via policy
        $this->authorize('view', $pre_admission_consent);

        return response()->json(
            [
                'message' => 'Pre Admission Consent for Your Organization',
                'data' => $pre_admission_consent,
            ],
            Response::HTTP_OK
        );
    }
}
