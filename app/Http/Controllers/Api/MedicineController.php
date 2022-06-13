<?php

namespace App\Http\Controllers\Api;

use App\Events\Medicine\ExpirationDateEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Medicines\AlternativeRequest;
use App\Http\Requests\Medicines\MedicineStoreRequest;
use App\Http\Requests\Medicines\MedicineUpdateRequest;
use App\Models\AlternativeMedicine;
use App\Models\Company;
use App\Models\Material;
use App\Models\MaterialMedicine;
use App\Models\Medicine;
use App\Models\MedicineUser;
use App\Models\Shelf;
use App\Notifications\MedicineNotification;
use Illuminate\Auth\Access\AuthorizationException;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;

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
        Gate::forUser(auth('api')->user())->authorize('viewMedicine');
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
         * @var Shelf $shelf ;
         * @var Company $company ;
         * @var Material $material ;
         * @var Medicine $medicine ;
         * @var Medicine $alternative ;
         */
        Gate::forUser(auth('api')->user())->authorize('createMedicine');
        $data = $request->validated();
        if (isset($data['shelf_name'])) {
            $shelf = Shelf::query()->create($data);

        }
        if (isset($data['company_name'])) {
            $company = Company::query()->create($data);

        }
        $data['shelf_id'] = $shelf->id;
        $data['company_id'] = $company->id;
        $medicine = Medicine::query()->where('name', $data['name'])->first();
        if ($medicine == null) {
            $medicine = Medicine::query()->create($data);
        }
        $data['medicine_id'] = $medicine->id;
        if (isset($data['material_id'])) {
            MaterialMedicine::query()->create($data);
        }
        $data['pharmacy_id'] = auth('api')->user()->getAuthIdentifier();
        if (isset($data['alternative_id'])) {
            $alternative = Medicine::query()->findOrFail($data['alternative_id'])->first();
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
     * @throws AuthorizationException
     */
    public function show(Medicine $medicine): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('showMedicine', $medicine);
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
        if (isset($data['alternative_id'])) {
            $alternative = Medicine::query()->findOrFail($data['alternative_id'])->first();
            $data['alternative_id'] = $alternative->id;
        } else $data['alternative_id'] = $medicine->alternative_id;
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


    public function pharmacies(Medicine $medicine): JsonResponse
    {

        $pharmacies = $medicine->users;
        return $this->getJsonResponse($pharmacies, 'pharmacies');
    }

    public function materials(Medicine $medicine): JsonResponse
    {

        $materials = $medicine->materials;
        return $this->getJsonResponse($materials, 'materials');

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
         * @var array $response
         */
        $user = auth('api')->user();
        $medicines = $user->medicines;
        foreach ($medicines as $medicine) {
            if ($medicine->expiration_date < Date::now()) {
                $response[] = $medicine;
                $medicineData = [
                    'body' => 'A new Medicine is expired',
                    'thanks' => 'Thank you',
                    'medicineText' => $medicine->name,
                    'medicineUrl' => url('/'),
                    'medicine_id' => $medicine->id
                ];
                Notification::send($user, new MedicineNotification($medicineData));
                event(new ExpirationDateEvent($medicine));
            }
        }

        return $this->getJsonResponse($response, 'Expired Medicines');
    }

}
