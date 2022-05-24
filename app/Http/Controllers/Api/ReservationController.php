<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservations\ReservationStoreRequest;
use App\Http\Requests\Reservations\ReservationUpdateRequest;
use App\Models\Reservation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;


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
     * @throws AuthorizationException
     */
    public function store(ReservationStoreRequest $request): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('createReservation');
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
     * @throws AuthorizationException
     */
    public function show(Reservation $reservation): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('createReservation',$reservation);

        return $this->getJsonResponse($reservation,'reservation');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReservationUpdateRequest $request
     * @param Reservation $reservation
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(ReservationUpdateRequest $request, Reservation $reservation): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('createReservation',$reservation);

        $data = $request->validated();
        $reservation->update($data);
        return $this->getJsonResponse($data,'Reservation Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reservation $reservation
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Reservation $reservation): JsonResponse
    {
        //
        Gate::forUser(auth('api')->user())->authorize('createReservation',$reservation);
        $reservation->delete();
        return $this->getJsonResponse($reservation,'Reservation Deleted Successfully');
    }
}
