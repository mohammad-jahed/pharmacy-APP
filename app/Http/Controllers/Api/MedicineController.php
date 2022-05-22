<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicines\MedicineStoreRequest;
use App\Http\Requests\Medicines\MedicineUpdateRequest;
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
    //sdsdsdsdsdsdsddsdsddsdsdsdsdsd
    public function update(MedicineUpdateRequest $request, Medicine $medicine): JsonResponse
    {
        Gate::forUser(auth('api')->user())->authorize('updateMedicine', $medicine);
        $data = $request->validated();
        $data['shelf_id'] = $medicine->shelf_id;
        $data['company_id'] = $medicine->company_id;
        if ($request->hasFile('shelf_name')) {
            Shelf::query()->update($data);
        }
        if ($request->hasFile('company_name')) {
            Company::query()->update($data);
        }
        $medicine->update($data);
        return $this->getJsonResponse($medicine, 'Medicine Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Medicine $medicine
     * @return JsonResponse
     */
    public function destroy(Medicine $medicine): JsonResponse
    {
        //
        $shelf = Shelf::query()->findOrFail($medicine->shelf_id);
        $company = Company::query()->findOrFail($medicine->company_id);
        $medicine->delete();
        $shelf->delete();
        $company->delete();
        return $this->getJsonResponse($medicine, 'Medicine Deleted Successfully');
    }
}
