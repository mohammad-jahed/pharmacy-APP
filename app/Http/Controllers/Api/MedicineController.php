<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicines\AlternativeRequest;
use App\Http\Requests\Medicines\MedicineStoreRequest;
use App\Http\Requests\Medicines\MedicineUpdateRequest;
use App\Models\Company;
use App\Models\Material;
use App\Models\Medicine;
use App\Models\Shelf;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Date;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        //
        $this->authorize('viewAny',Medicine::class);
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
         * @var Medicine $medicine;
         */
        $this->authorize('create', Medicine::class);
        $data = $request->validated();

        if (isset($data['company_name'])) {
            $company = Company::firstOrCreate(['company_name' => $data['company_name']]);
            $data['company_id'] = $company->id;
        }

        $medicine = Medicine::query()->create($data);
        if (isset($data['shelf_names'])) {
            foreach ($data['shelf_names'] as $shelf_name){
                $shelf = Shelf::firstOrCreate(['shelf_name'=>$shelf_name]);
                $medicine->shelves()->attach($shelf->id);

            }
        }

        $medicine->materials()->attach($data['material_ids']);
        $medicine->users()->attach(auth()->id());
        if (isset($data['alternative_ids'])) {
            $medicine->alternatives()->attach($data['alternative_ids']);
        }
        return $this->getJsonResponse($medicine, 'Medicine Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Medicine $medicine
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Medicine $medicine): JsonResponse
    {
        //
        $this->authorize('view',$medicine);
        //Gate::forUser(auth('api')->user())->authorize('showMedicine', $medicine);
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
        $this->authorize('update',$medicine);
        $data = $request->validated();



        if (isset($data['alternative_ids'])) {
            $medicine->alternatives()->sync($data['alternative_ids']);
        }
        if (isset($data['shelf_names'])) {
            foreach ($data['shelf_names'] as $shelf_name){
                $shelf = Shelf::firstOrCreate(['shelf_name'=>$shelf_name]);
                $medicine->shelves()->attach($shelf->id);
            }
        }
        if(isset($data['material_ids'])){
            $medicine->materials()->sync($data['material_ids']);
        }
        $medicine->update($data);

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
        $this->authorize('delete',$medicine);
        //Gate::forUser(auth('api')->user())->authorize('deleteMedicine', $medicine);
        $medicine->delete();
        return $this->getJsonResponse($medicine, 'Medicine Deleted Successfully');
    }


    /**
     * @throws AuthorizationException
     */
    public function pharmacies(Medicine $medicine): JsonResponse
    {
        $this->authorize('materials',$medicine);
        $pharmacies = $medicine->users;
        return $this->getJsonResponse($pharmacies, 'pharmacies');
    }

    /**
     * @throws AuthorizationException
     */
    public function materials(Medicine $medicine): JsonResponse
    {
        $this->authorize('materials',$medicine);
        $materials = $medicine->materials;
        return $this->getJsonResponse($materials, 'materials');

    }

    /**
     * @throws AuthorizationException
     */
    public function shelves(Medicine $medicine):JsonResponse{
        $this->authorize('shelves',$medicine);
        $shelves = $medicine->shelves;
        return $this->getJsonResponse($shelves, 'shelves');

    }

    public function alternatives(AlternativeRequest $request, int $count = 0, array $response2 = null, array $response3 = null): JsonResponse
    {
        /**
         * @var Material[] $materials
         * @var Material $material
         * @var Medicine[] $alternatives ;
         * @var Medicine $medicine ;
         * @var Medicine $alternative ;
         * @var Material[] $alternativeMaterials ;
         * @var Material $alternativeMaterial ;
         */
        $data = $request->validated();
        $medicine = Medicine::query()->findOrFail($data['medicine_id']);
        $materials = $medicine->materials;
        foreach ($materials as $material) {
            $alternatives = $material->medicines;
            if ($data['number'] == 1) {
                return $this->getJsonResponse($alternatives, "Alternatives With One Component");
            }
            foreach ($alternatives as $alternative) {
                $alternativeMaterials = $alternative->materials;
                foreach ($alternativeMaterials as $alternativeMaterial) {
                    if ($material->is($alternativeMaterial)) {
                        $count++;
                    }
                }
                if ($count == 2) {
                    $response2 [] = $alternative;
                }
                if ($count == count($materials)) {
                    $response3 [] = $alternative;
                }
                break;
            }
        }

        if ($data['number'] == 2) {
            return $this->getJsonResponse($response2, "Alternatives with two components");
        } else {
            return $this->getJsonResponse($response3, "Alternatives with full components");
        }
    }

    public function expiredMedicines(): JsonResponse
    {
        /**
         * @var Medicine[] $medicines ;
         * @var Medicine $medicine ;
         * @var User $user;
         * @var array $response
         */
        $user = auth('api')->user();
        $medicines = $user->medicines;
        foreach ($medicines as $medicine) {

            if ($medicine->expiration_date < Date::now()) {
                $response[] = $medicine;
            }
        }

        return $this->getJsonResponse($response, 'Expired Medicines');
    }

    public function displayedMedicines(): JsonResponse
    {
        /**
         * @var Medicine[] $medicines ;
         * @var Medicine $medicine ;
         * @var User $user;
         * @var array $response
         */
        $user = auth('api')->user();
        $medicines = $user->medicines;
        foreach ($medicines as $medicine) {

            if ($medicine->quantity <= 5) {
                $response[] = $medicine;
            }
        }
        return $this->getJsonResponse($response,'run out medicines');

    }

}
