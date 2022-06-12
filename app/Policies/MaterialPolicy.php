<?php

namespace App\Policies;

use App\Models\Material;
use App\Models\Medicine;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MaterialPolicy
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
        return ($user->hasRole('Pharmacy'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Material $material
     * @return Response|bool
     */
    public function view(User $user, Material $material): Response|bool
    {
        //
        /**
         * @var Medicine[] $medicines;
         * @var Medicine $medicine;
         * @var User[] $users;
         * @var User $newUser;
         */
        $medicines = $material->medicines;
        foreach ($medicines as $medicine){
            $users = $medicine->users;
            foreach ($users as $newUser){
                if($user->id == $newUser->id){
                    return true;
                }
            }
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
        return $user->hasRole('Pharmacy');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Material $material
     * @return Response|bool
     */
    public function update(User $user, Material $material): Response|bool
    {
        //
        /**
         * @var Medicine[] $medicines;
         * @var Medicine $medicine;
         * @var User[] $users;
         * @var User $newUser;
         */
        $medicines = $material->medicines;
        foreach ($medicines as $medicine){
            $users = $medicine->users;
            foreach ($users as $newUser){
                if($user->id == $newUser->id){
                    return true;
                }
            }
        }
        return false;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Material $material
     * @return Response|bool
     */
    public function delete(User $user, Material $material): Response|bool
    {
        //
        /**
         * @var Medicine[] $medicines;
         * @var Medicine $medicine;
         * @var User[] $users;
         * @var User $newUser;
         */
        $medicines = $material->medicines;
        foreach ($medicines as $medicine){
            $users = $medicine->users;
            foreach ($users as $newUser){
                if($user->id == $newUser->id){
                    return true;
                }
            }
        }
        return false;
    }
}
