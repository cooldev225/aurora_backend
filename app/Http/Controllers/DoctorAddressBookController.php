<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\DoctorAddressBook;
use App\Http\Requests\DoctorAddressBookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorAddressBookController extends Controller
{
    /**
     * [Doctor Address Book] - All
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', DoctorAddressBook::class);

        $doctorAddressBooks = DoctorAddressBook::where('organization_id', auth()->user()->organization_id)->get();

        return response()->json(
            [
                'message'   => 'Doctor Address Book List',
                'data'      => $doctorAddressBooks,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Doctor Address Book] - Search
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', DoctorAddressBook::class);

        $term = $request->term;

        if (trim($term) == '') {
            return response()->json(
                [
                    'data'  => [],
                ],
                Response::HTTP_OK
            );
        }

        $keyword = '%' . $term . '%';

        $arrDoctorAddressBooks = DoctorAddressBook::whereRaw(
                'CONCAT(`first_name`, \' \', `last_name`) LIKE "' . $keyword . '"')
            ->orWhere('address', 'LIKE', $keyword)
            ->orWhere('provider_no', 'LIKE', $keyword)
            ->limit(10)
            ->get();

        $result = [];
        foreach ($arrDoctorAddressBooks as $doctor) {
            $info = '<i class="fa  fa-user-md"></i> ' . $doctor->title . ' '
                . $doctor->first_name . ' ' . $doctor->last_name
                . '<br /><i class="fa fa-map-marker"></i> ' . $doctor->address
                . '<br /><i class="fa fa-hand-o-right"></i> ' . $doctor->provider_no
                . '<br /><i class="fa fa-phone"></i> ' . $doctor->country_extension
                . ' ' . $doctor->mobile;

            $result[] =  [
                'id'    =>  $doctor->id,
                'text'  =>  $info
            ];
        }

        return response()->json(
            [
                'data'  => $result,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Doctor Address Book] - Store
     *
     * @param  \App\Http\Requests\DoctorAddressBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorAddressBookRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', DoctorAddressBook::class);

        $doctorAddressBook = DoctorAddressBook::create([
            ...$request->validated(),
            'organization_id' => auth()->user()->organization_id
        ]);

        return response()->json(
            [
                'message' => 'New Doctor Address Book created',
                'data' => $doctorAddressBook,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Doctor Address Book] - Update
     *
     * @param  \App\Http\Requests\DoctorAddressBookRequest  $request
     * @param  \App\Models\DoctorAddressBook  $doctorAddressBook
     * @return \Illuminate\Http\Response
     */
    public function update(
        DoctorAddressBookRequest $request,
        DoctorAddressBook $doctorAddressBook
    ) {
        // Verify the user can access this function via policy
        $this->authorize('update', $doctorAddressBook);

        $doctorAddressBook->update([
            ...$request->validated()
        ]);

        return response()->json(
            [
                'message' => 'Doctor Address Book updated',
                'data' => $doctorAddressBook,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * [Doctor Address Book] - Destroy
     *
     * @param  \App\Models\DoctorAddressBook  $doctorAddressBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorAddressBook $doctorAddressBook)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $doctorAddressBook);

        $doctorAddressBook->delete();

        return response()->json(
            [
                'message' => 'Doctor Address Book Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
