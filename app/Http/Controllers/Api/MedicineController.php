<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicines\MedicineStoreRequest;
use App\Http\Requests\Medicines\MedicineUpdateRequest;
use App\Models\Company;
use App\Models\Medicine;
use App\Models\Shelf;
use Illuminate\Http\JsonResponse;


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
        return $this->getJsonResponse($medicine,'medicines');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MedicineStoreRequest $request
     * @return JsonResponse
     */
    public function store(MedicineStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        Shelf::query()->create($data);
        Company::query()->create($data);
        $medicine = Medicine::query()->create($data);
        return $this->getJsonResponse($medicine,'Medicine Created Successfully');
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
        return $this->getJsonResponse($medicine,'Success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MedicineUpdateRequest $request
     * @param Medicine $medicine
     * @return JsonResponse
     */
    public function update(MedicineUpdateRequest $request, Medicine $medicine): JsonResponse
    {
        //
        $data = $request->validated();
        $medicine->update($data);
        $shelf = Shelf::query()->where('shelf_name',$data['shelf_name'])->get();
        Shelf::query()->update($shelf);
        $company = Company::query()->where('company_name',$data['company_name'])->get();
        Company::query()->update($company);
        return $this->getJsonResponse($medicine,'Medicine Updated Successfully');
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
        $medicine->delete();
        return $this->getJsonResponse($medicine,'Medicine Deleted Successfully');
    }
}
