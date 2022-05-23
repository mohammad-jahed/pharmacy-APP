<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicines\MedicineStoreRequest;
use App\Http\Requests\Medicines\MedicineUpdateRequest;
use App\Models\AlternativeMedicine;
use App\Models\Company;
use App\Models\Medicine;
use App\Models\MedicineUser;
use App\Models\Shelf;
use Illuminate\Auth\Access\AuthorizationException;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;


class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        //
        $medicine = Medicine::all();
        return $this->getJsonResponse($medicine, 'medicines');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MedicineStoreRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(MedicineStoreRequest $request): JsonResponse
    {
        /**
         * @var Shelf $shelf;
         * @var Company $company;
         * @var Medicine $medicine;
         * @var Medicine $alternative;
         */
        Gate::forUser(auth('api')->user())->authorize('createMedicine');
        $data = $request->validated();
        $shelf = Shelf::query()->create($data);
        $company = Company::query()->create($data);
        $data['shelf_id'] = $shelf->id;
        $data['company_id'] = $company->id;
        $medicine = Medicine::query()->create($data);
        $data['medicine_id'] = $medicine->id;
        $data['pharmacy_id'] = auth('api')->user()->getAuthIdentifier();
        if(isset($data['alternative_id'])){
            $alternative  = Medicine::query()->findOrFail($data['alternative_id'])->first();
            $data['alternative_id'] = $alternative->id;
            AlternativeMedicine::query()->create($data);
        }
        MedicineUser::query()->create($data);
        return $this->getJsonResponse($medicine, 'Medicine Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Medicine $medicine
     * @return JsonResponse
     */
    public function show(Medicine $medicine): JsonResponse
    {
        //
        return $this->getJsonResponse($medicine, 'Success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MedicineUpdateRequest $request
     * @param Medicine $medicine
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(MedicineUpdateRequest $request, Medicine $medicine): JsonResponse
    {
        Gate::forUser(auth('api')->user())->authorize('updateMedicine', $medicine);
        $data = $request->validated();
        if(isset($data['alternative_id'])){
            $alternative  = Medicine::query()->findOrFail($data['alternative_id'])->first();
            $data['alternative_id'] = $alternative->id;
        }
        else $data['alternative_id'] = $medicine->alternative_id;
        $medicine->update($data);
        if (isset($data['shelf_name'])) {
            Shelf::query()->update($data);
        }
        if (isset($data['company_name'])) {
            Company::query()->update($data);
        }

        return $this->getJsonResponse($medicine, 'Medicine Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Medicine $medicine
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Medicine $medicine): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('deleteMedicine', $medicine);
        $medicine->delete();
        return $this->getJsonResponse($medicine, 'Medicine Deleted Successfully');
    }
    public function alternatives(Medicine $medicine): JsonResponse
    {
        $alternatives = $medicine->alternatives;
        return $this->getJsonResponse($alternatives,'alternatives');
    }
}
