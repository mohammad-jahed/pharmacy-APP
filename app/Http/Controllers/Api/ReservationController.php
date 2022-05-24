<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservations\ReservationStoreRequest;
use App\Http\Requests\Reservations\ReservationUpdateRequest;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        //
        $reservations = Reservation::all();
        return $this->getJsonResponse($reservations,'reservations');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReservationStoreRequest $request
     * @return JsonResponse
     */
    public function store(ReservationStoreRequest $request): JsonResponse
    {
        //
        $data = $request->validated();
        $data['user_id'] = auth('api')->user()->getAuthIdentifier();
        $reservation = Reservation::query()->create($data);
        return $this->getJsonResponse($reservation,'Reservation Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Reservation $reservation
     * @return JsonResponse
     */
    public function show(Reservation $reservation): JsonResponse
    {
        //
        return $this->getJsonResponse($reservation,'reservation');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReservationUpdateRequest $request
     * @param Reservation $reservation
     * @return JsonResponse
     */
    public function update(ReservationUpdateRequest $request, Reservation $reservation): JsonResponse
    {
        //
        $data = $request->validated();
        $reservation->update($data);
        return $this->getJsonResponse($data,'Reservation Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reservation $reservation
     * @return JsonResponse
     */
    public function destroy(Reservation $reservation): JsonResponse
    {
        //
        $reservation->delete();
        return $this->getJsonResponse($reservation,'Reservation Deleted Successfully');
    }
}
