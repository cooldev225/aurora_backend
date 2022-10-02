<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use App\Http\Requests\BulletinRequest;
use Illuminate\Http\Response;

class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            [
                'message' => 'New Patient Recall created',
                'data' => auth()->user()->organization->bulletin,
            ],
            Response::HTTP_CREATED
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BulletinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BulletinRequest $request)
    { 
        // Verify the user can access this function via policy
         $this->authorize('create', Bulletin::class);

        $bulletin = Bulletin::create([
            'organization_id' => auth()->user()->organization_id,
            'created_by' => auth()->user()->id,
            ...$request->validated(),
        ]);

        return response()->json(
            [
                'message' => 'New BulletinW created',
                'data' => $bulletin,
            ],
            Response::HTTP_CREATED
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bulletin  $bulletin
     * @return \Illuminate\Http\Response
     */
    public function show(Bulletin $bulletin)
    {
    // Verify the user can access this function via policy
    $this->authorize('show', $bulletin);

    return response()->json(
        [
            'message' => 'Bulletin requested',
            'data' => $bulletin,
        ],
        Response::HTTP_OK
    );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBulletinRequest  $request
     * @param  \App\Models\Bulletin  $bulletin
     * @return \Illuminate\Http\Response
     */
    public function update(BulletinRequest $request, Bulletin $bulletin)
    {
          // Verify the user can access this function via policy
          $this->authorize('update', $bulletin);

          $bulletin->update([
              ...$request->validated(),
          ]);
  
          return response()->json(
              [
                  'message' => 'Bulletin updated',
                  'data' => $bulletin,
              ],
              Response::HTTP_OK
          );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bulletin  $bulletin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bulletin $bulletin)
    {
         // Verify the user can access this function via policy
         $this->authorize('delete', $bulletin);

         $bulletin->delete();
 
         return response()->json(
             [
                 'message' => 'Bulletin Removed',
             ],
             Response::HTTP_NO_CONTENT
         );
    }
}
