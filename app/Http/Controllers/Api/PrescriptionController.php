<?php

namespace App\Http\Controllers\Api;

use App\Events\Prescription\PrescriptionCreateEvent;
use App\Events\Prescription\UserPrescriptionEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\NearestPharmaciesRequest;
use App\Http\Requests\Prescriptions\PrescriptionStoreRequest;
use App\Http\Requests\Prescriptions\PrescriptionUpdateRequest;
use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        //
        $prescriptions = Prescription::all();
        $medicines=Medicine::all();
        return view('pages.Prescriptions.prescriptions_list',compact('prescriptions','medicines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PrescriptionStoreRequest $request
     * @return JsonResponse
     */
    public function store(PrescriptionStoreRequest $request): JsonResponse
    {
        //
        /**
         * @var Prescription $prescription;
         * @var User $admin;
         */

        $data = $request->validated();
        $request->file('imagePath')->store('public/images');
        $file_name = $request->file('imagePath')->hashName();
        $data['imagePath'] = $file_name;
        $data['user_id'] = auth('api')->user()->getAuthIdentifier();
        $prescription = Prescription::query()->create($data);
        $admin = User::type('Admin')->first();
        event(new PrescriptionCreateEvent($admin,$prescription));
        return $this->getJsonResponse($prescription,'Prescription Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param Prescription $prescription
     * @return JsonResponse
     */
    public function show(Prescription $prescription): JsonResponse
    {
        //
        return $this->getJsonResponse($prescription,'prescription');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PrescriptionUpdateRequest $request
     * @param Prescription $prescription
     * @return JsonResponse
     */
    public function update(PrescriptionUpdateRequest $request, Prescription $prescription): JsonResponse
    {
        //
        $data = $request->validated();
        $prescription->update($data);
        return $this->getJsonResponse($prescription,'Prescription Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Prescription $prescription
     * @return JsonResponse
     */
    public function destroy(Prescription $prescription): JsonResponse
    {
        //
        $prescription->delete();
        return $this->getJsonResponse($prescription,'Prescription deleted successfully');
    }


        public function userPrescriptionnotify(NearestPharmaciesRequest $request): \Illuminate\Http\RedirectResponse
        {
            /**
             * @var array $result;
             */
            //$this->authorize('nearestPharmacies', User::class);
            $data = $request->validated();
            foreach ($data['medicines'] as $medicineData) {
                $pharmacies = User::query()->whereHas('medicines', function (Builder $builder) use ($medicineData, $data) {
                    $builder->where('name_' . app()->getLocale(), 'like', "%$medicineData%")->whereHas('users', function (Builder $builder) use ($data) {
                        $builder->whereHas('address', function (Builder $builder) use ($data) {
                            $builder->where('area_id', $data['area_id']);
                        });
                    });
                })->get();

                $response = [
                    'medicine' => $medicineData,
                    'The Nearest Pharmacies' => $pharmacies
                ];
                $result[] = $response;
            }
            $user=User::find($request->user_id);
            event(new UserPrescriptionEvent($user,$result));
           $prescription= Prescription::find($request->prescription_id);
            $prescription->delete();
            return redirect()->back();
//            return self::getJsonResponse($result, "the nearest pharmacies");
        }


}
