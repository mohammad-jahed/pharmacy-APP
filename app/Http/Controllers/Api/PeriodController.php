<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Periods\PeriodStoreRequest;
use App\Http\Requests\Periods\PeriodUpdateRequest;
use App\Models\Period;
use App\Models\Reservation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class PeriodController extends Controller
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
        Gate::forUser(auth('api')->user())->authorize('indexPeriod');
        $periods = Period::all();
        return $this->getJsonResponse($periods,'periods');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PeriodStoreRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(PeriodStoreRequest $request): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('createPeriod');
        $data = $request->validated();
        $period = Period::query()->create($data);
        return $this->getJsonResponse($period,'Period Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Period $period
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Period $period): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('showPeriod',$period);
        return $this->getJsonResponse($period,'period');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PeriodUpdateRequest $request
     * @param Period $period
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(PeriodUpdateRequest $request, Period $period): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('updatePeriod',$period);
        $data = $request->validated();
        $period->update($data);
        return $this->getJsonResponse($data,'Period Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Period $period
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Period $period): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('deletePeriod',$period);
        $period->delete();
        return $this->getJsonResponse($period,'Period Deleted Successfully');
    }

    public function users(Period $period): JsonResponse
    {
        /**
         * @var Reservation[] $reservations;
         */
        $reservations = $period->reservations;
        $response = null;
        foreach ($reservations as $reservation){
            $response[] = $reservation->users;
        }
        return $this->getJsonResponse($response,'users');
    }
}
