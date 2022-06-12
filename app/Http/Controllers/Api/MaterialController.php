<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Materials\MaterialStoreRequest;
use App\Http\Requests\Materials\MaterialUpdateRequest;
use App\Models\Material;
use App\Models\Medicine;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;


class MaterialController extends Controller
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
        /**
         * @var Medicine[] $medicines;
         * @var Medicine $medicine;
         * @var array $materials;
         * @var User $user;
         */
        $user = auth('api')->user();
        Gate::forUser(auth('api')->user())->authorize('viewMaterials');
        $medicines = $user->medicines;
        foreach ($medicines as $medicine){
            $materials[] = $medicine->materials;
        }


        return $this->getJsonResponse(array_unique($materials), 'Materials');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MaterialStoreRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(MaterialStoreRequest $request): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('createMaterial');

        $data = $request->validated();
        $material = Material::query()->create($data);
        return $this->getJsonResponse($material, 'Material Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param Material $material
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Material $material): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('showMaterial', $material);
        return $this->getJsonResponse($material, 'material');
    }

    /*public function materialsWithinComponent(Material $material): JsonResponse
    {

        return $this->getJsonResponse($data,'materials');
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param MaterialUpdateRequest $request
     * @param Material $material
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(MaterialUpdateRequest $request, Material $material): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('updateMaterial', $material);

        $data = $request->validated();
        $material->update($data);
        return $this->getJsonResponse($material, 'Material Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Material $material
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Material $material): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('deleteMaterial', $material);
        $material->delete();
        return response()->json(['message' => 'Material Deleted Successfully']);
    }

    public function medicines(Material $material)
    {

        $medicines = $material->medicines;
        return $this->getJsonResponse($medicines, "Medicines");
    }

}
