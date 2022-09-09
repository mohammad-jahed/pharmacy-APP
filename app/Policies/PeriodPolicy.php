<?php

namespace App\Policies;

use App\Models\Period;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PeriodPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool
    {
        //
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Period $period
     * @return Response|bool
     */
    public function view(User $user, Period $period): Response|bool
    {
        //
        /**
         * @var User $user1 ;
         * @var User $pharmacy ;
         * @var Reservation[] $reservations ;
         * @Var Reservation $reservation ;
         */
        if ($user->hasRole('Admin')) return true;
        $reservations = $period->reservations;
        foreach ($reservations as $reservation) {
            $user1 = $reservation->user;
            $pharmacy = $reservation->pharmacy;
            return ($user->id == $user1->id || $user->id == $pharmacy->id);
        }
        return false;
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
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Period $period
     * @return Response|bool
     */
    public function update(User $user, Period $period): Response|bool
    {
        //
        /**
         * @var User $user1 ;
         * @var User $pharmacy ;
         * @var Reservation[] $reservations ;
         * @Var Reservation $reservation ;
         */
        if ($user->hasRole('Admin')) return true;
        $reservations = $period->reservations;
        foreach ($reservations as $reservation) {
            $user1 = $reservation->user;
            $pharmacy = $reservation->pharmacy;
            return ($user->id == $user1->id || $user->id == $pharmacy->id);
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Period $period
     * @return Response|bool
     */
    public function delete(User $user, Period $period): Response|bool
    {
        //
        /**
         * @var User $user1 ;
         * @var User $pharmacy ;
         * @var Reservation[] $reservations ;
         * @Var Reservation $reservation ;
         */
        if ($user->hasRole('Admin')) return true;
        $reservations = $period->reservations;
        foreach ($reservations as $reservation) {
            $user1 = $reservation->user;
            $pharmacy = $reservation->pharmacy;
            return ($user->id == $user1->id || $user->id == $pharmacy->id);
        }
        return false;
    }

}
