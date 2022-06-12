<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ReservationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function index(User $user): Response|bool
    {
        //
        return $user->hasRole('Admin');
    }

    public function viewAnyPharmacy(User $user): bool
    {
        return $user->hasRole('Pharmacy');
    }


    public function viewAnyUser(User $user): bool
    {
        return $user->hasRole('User');
    }


    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Reservation $reservation
     * @return Response|bool
     */
    public function view(User $user, Reservation $reservation): Response|bool
    {
        //
        /**
         * @var User $pharmacy ;
         * @var User $user1 ;
         */
        $pharmacy = $reservation->pharmacy;
        $user1 = $reservation->user;
        return $user->id == $pharmacy->id || $user->id == $user1->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        //
        return $user->hasRole('User');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Reservation $reservation
     * @return Response|bool
     */
    public function update(User $user, Reservation $reservation): Response|bool
    {
        //
        /**
         * @var User $pharmacy ;
         * @var User $user1 ;
         */
        $pharmacy = $reservation->pharmacy;
        $user1 = $reservation->user;
        return $user->id == $pharmacy->id || $user->id == $user1->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Reservation $reservation
     * @return Response|bool
     */
    public function delete(User $user, Reservation $reservation): Response|bool
    {
        //
        /**
         * @var User $pharmacy ;
         * @var User $user1 ;
         */
        $pharmacy = $reservation->pharmacy;
        $user1 = $reservation->user;
        return $user->id == $pharmacy->id || $user->id == $user1->id;
    }

}
