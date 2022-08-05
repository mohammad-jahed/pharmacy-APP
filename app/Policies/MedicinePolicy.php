<?php

namespace App\Policies;

use App\Models\Medicine;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MedicinePolicy
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
        return ($user->hasRole('Pharmacy'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Medicine $model
     * @return Response|bool
     */
    public function view(User $user, Medicine $model): Response|bool
    {
        //
        /**
         * @var User $newUser ;
         * @var User[] $user ;
         */
        $users = $model->users;
        foreach ($users as $newUser) {
            if ($user->id == $newUser->id) {
                return true;
            }
        }
        return false;

    }

    public function materials(User $user, Medicine $model): Response|bool
    {
        /**
         * @var User[] $users
         */
        $users = $model->users;
        foreach ($users as $user1){
            return ($user->id == $user1->id) && ($user1->hasRole('Pharmacy'));
        }
        return false;
    }

    public function shelves(User $user, Medicine $model): Response|bool
    {
        /**
         * @var User[] $users
         */
        $users = $model->users;
        foreach ($users as $user1){
            return ($user->id == $user1->id) && ($user1->hasRole('Pharmacy'));
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User|null $user
     * @return Response|bool
     */
    public function create(?User $user): Response|bool
    {
        return ($user->hasRole('Pharmacy'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Medicine $model
     * @return Response|bool
     */
    public function update(User $user, Medicine $model): Response|bool
    {
        //
        /**
         * @var User $newUser ;
         * @var User[] $user ;
         */
        $users = $model->users;
        foreach ($users as $newUser) {
            if ($user->id == $newUser->id) {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Medicine $model
     * @return Response|bool
     */
    public function delete(User $user, Medicine $model): Response|bool
    {
        //
        /**
         * @var User $newUser ;
         * @var User[] $user ;
         */
        $users = $model->users;
        foreach ($users as $newUser) {
            if ($user->id == $newUser->id) {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Medicine $medicine
     * @return Response|bool
     */
    /*
    public function restore(User $user, Medicine $medicine)
    {
        //
    }*/

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Medicine $medicine
     * @return Response|bool
     */
    /*
    public function forceDelete(User $user, Medicine $medicine)
    {
        //
    }*/
}
