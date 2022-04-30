<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

//        DB::table('users')->insert([
//            'username' => 'admin33',
//            'email' => 'admin33@gmail.com',
//            'password' => Hash::make('00000000'),
//            'imagePath'=>'OpI7f8njcHKJ5p4gPMEz2r8N2foufyTev5Q9elc2.jpg'
//        ]);
////////////////////////////////// creating the admin ///////////////////////////////////////////////////
        $user=User::query()->create([
            'username'=> 'admin33',
            'email'   => 'admin33@gmail.com',
            'password'=> Hash::make('00000000')

        ]);
        /////////////////////assign role to the Admin/////////////////////////////////
        $role =Role::query()->where('name','like','Admin')->get();
        $user->assignRole($role);
//////////////////////////// give permissions to the Admin /////////////////////////////////////////////////
        $p1 = Permission::query()->where('name','like','add pharmacy')->get();
        $p2 = Permission::query()->where('name','like','delete pharmacy')->get();
        $p3 = Permission::query()->where('name','like','add state')->get();
        $p4 = Permission::query()->where('name','like','update state')->get();
        $p5 = Permission::query()->where('name','like','delete state')->get();
        $p6 = Permission::query()->where('name','like','add city')->get();
        $p7 = Permission::query()->where('name','like','update city')->get();
        $p8 = Permission::query()->where('name','like','delete city')->get();
        $p9 = Permission::query()->where('name','like','add area')->get();
        $p10 = Permission::query()->where('name','like','update area')->get();
        $p11 = Permission::query()->where('name','like','delete area')->get();
        $p12 = Permission::query()->where('name','like','add company')->get();
        $p13 = Permission::query()->where('name','like','update company')->get();
        $p14 = Permission::query()->where('name','like','delete company')->get();
        $p15 = Permission::query()->where('name','like','add notification')->get();
        $p16 = Permission::query()->where('name','like','delete notification')->get();

        $user->givePermissionTo($p1);
        $user->givePermissionTo($p2);
        $user->givePermissionTo($p3);
        $user->givePermissionTo($p4);
        $user->givePermissionTo($p5);
        $user->givePermissionTo($p6);
        $user->givePermissionTo($p7);
        $user->givePermissionTo($p8);
        $user->givePermissionTo($p9);
        $user->givePermissionTo($p10);
        $user->givePermissionTo($p11);
        $user->givePermissionTo($p12);
        $user->givePermissionTo($p13);
        $user->givePermissionTo($p14);
        $user->givePermissionTo($p15);
        $user->givePermissionTo($p16);

    }
}
