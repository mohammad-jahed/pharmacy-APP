<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Periods\PeriodStoreRequest;
use App\Http\Requests\Periods\PeriodUpdateRequest;
use App\Models\Period;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        //
        $periods = Period::all();
        return $this->getJsonResponse($periods,'periods');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PeriodStoreRequest $request
     * @return JsonResponse
     */
    public function store(PeriodStoreRequest $request): JsonResponse
    {
        //
        $data = $request->validated();
        $period = Period::query()->create($data);
        return $this->getJsonResponse($period,'Period Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Period $period
     * @return JsonResponse
     */
    public function show(Period $period): JsonResponse
    {
        //
        return $this->getJsonResponse($period,'period');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PeriodUpdateRequest $request
     * @param Period $period
     * @return JsonResponse
     */
    public function update(PeriodUpdateRequest $request, Period $period): JsonResponse
    {
        //
        $data = $request->validated();
        $period->update($data);
        return $this->getJsonResponse($data,'Period Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Period $period
     * @return JsonResponse
     */
    public function destroy(Period $period): JsonResponse
    {
        //
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
