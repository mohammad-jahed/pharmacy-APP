<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PharmacyPolicy
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
        return ($user->hasRole('Admin'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param User $model
     * @return Response|bool
     */
    public function view(User $user, User $model): Response|bool
    {
        return true;
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
        return $user->hasRole("Admin");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return Response|bool
     */
    public function update(User $user, User $model): Response|bool
    {
        //

        return ($user->id == $model->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param User $model
     * @return Response|bool
     */
    public function delete(User $user, User $model): Response|bool
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
        return ($user->id == $model->id);

    }

    public function nearestPharmacies(User $user): bool
    {
        return $user->hasRole('User');
    }



}
