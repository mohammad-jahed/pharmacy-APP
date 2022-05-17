<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
////////////////////////////////// creating the admin ///////////////////////////////////////////////////
        $user=User::query()->create([
            'username'=> 'admin33',
            'email'   => 'admin33@gmail.com',
            'password'=> '00000000'

        ]);
        /////////////////////assign role to the Admin/////////////////////////////////
        $role =Role::query()->where('name','like','Admin')->get();
        $user->assignRole($role);

    }
}
