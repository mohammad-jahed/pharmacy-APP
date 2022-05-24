<?php

namespace App\Policies;

use App\Models\Component;
use App\Models\Medicine;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ComponentPolicy
{
    use HandlesAuthorization;



    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Component $component
     * @return Response|bool
     */
    public function view(User $user, Component $component): Response|bool
    {
        //
        /**
         * @var Medicine $medicine;
         * @var User[] $users;
         * @var User $user1;
         */
        $medicine = $component->medicine;
        $users = $medicine->users;
        foreach ($users as $user1){
            if($user->id==$user1->id){
                return true;
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
     * @param Component $component
     * @return Response|bool
     */
    public function update(User $user, Component $component): Response|bool
    {
        //
        //
        /**
         * @var Medicine $medicine;
         * @var User[] $users;
         * @var User $user1;
         */
        $medicine = $component->medicine;
        $users = $medicine->users;
        foreach ($users as $user1){
            if($user->id==$user1->id){
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Component $component
     * @return Response|bool
     */
    public function delete(User $user, Component $component): Response|bool
    {
        //
        //
        /**
         * @var Medicine $medicine;
         * @var User[] $users;
         * @var User $user1;
         */
        $medicine = $component->medicine;
        $users = $medicine->users;
        foreach ($users as $user1){
            if($user->id==$user1->id){
                return true;
            }
        }
        return false;
    }

}
