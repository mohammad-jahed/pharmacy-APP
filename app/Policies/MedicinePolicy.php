<?php

namespace App\Policies;

use App\Models\Medicine;
use App\Models\MedicineUser;
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
         * @var Medicine $newUser
         */
        $newUser = $model->medicineUser()->first();
        return ($user->id == $newUser->pharmacy_id);
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
        /**
         * @var Medicine $newModel
         */
        $newModel = $model->medicineUser()->first();
        return ($user->id == $newModel->getAttributes()['pharmacy_id']);

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
         * @var Medicine $newModel
         */
        $newModel = $model->medicineUser()->first();
        return ($user->id == $newModel->getAttributes()['pharmacy_id']);

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
