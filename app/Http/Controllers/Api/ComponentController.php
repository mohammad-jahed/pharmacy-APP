<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Components\ComponentStoreRequest;
use App\Http\Requests\Components\ComponentUpdateRequest;
use App\Models\Component;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use function response;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        //
        $components = Component::all();
        return $this->getJsonResponse($components, 'components');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ComponentStoreRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(ComponentStoreRequest $request): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('createComponent');
        $data = $request->validated();
        $component = Component::query()->create($data);
        return $this->getJsonResponse($component, 'Component Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Component $component
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Component $component): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('showComponent',$component);
        return $this->getJsonResponse($component, 'component');
    }

    public function materialsComponent(Component $component): JsonResponse
    {
        $materials = $component->materials;
        return $this->getJsonResponse($materials,'materials');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ComponentUpdateRequest $request
     * @param Component $component
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(ComponentUpdateRequest $request, Component $component): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('updateComponent',$component);
        $data = $request->validated();
        $component->update($data);
        return $this->getJsonResponse($component, 'Component Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Component $component
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Component $component): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('deleteComponent',$component);
        $component->delete();
        return response()->json(['message' => 'Component Deleted Successfully']);
    }
}
