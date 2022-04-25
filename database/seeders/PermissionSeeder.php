<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permissions')->insert([
            //admin
            ['name' => 'add pharmacy', 'guard_name' => 'web'],
            ['name' => 'delete pharmacy', 'guard_name' => 'web'],
            ['name' => 'add state', 'guard_name' => 'web'],
            ['name' => 'update state', 'guard_name' => 'web'],
            ['name' => 'delete state', 'guard_name' => 'web'],
            ['name' => 'add city', 'guard_name' => 'web'],
            ['name' => 'update city', 'guard_name' => 'web'],
            ['name' => 'delete city', 'guard_name' => 'web'],
            ['name' => 'add area', 'guard_name' => 'web'],
            ['name' => 'update area', 'guard_name' => 'web'],
            ['name' => 'delete area', 'guard_name' => 'web'],
            ['name' => 'add user', 'guard_name' => 'web'],
            ['name' => 'delete delete', 'guard_name' => 'web'],
            ['name' => 'add company', 'guard_name' => 'web'],
            ['name' => 'update company', 'guard_name' => 'web'],
            ['name' => 'delete company', 'guard_name' => 'web'],
            ['name' => 'add notification', 'guard_name' => 'web'],
            ['name' => 'delete notification', 'guard_name' => 'web'],
            //pharmacy
            ['name' => 'add shelf', 'guard_name' => 'api'],
            ['name' => 'update shelf', 'guard_name' => 'api'],
            ['name' => 'delete shelf', 'guard_name' => 'api'],
            ['name' => 'add medicine', 'guard_name' => 'api'],
            ['name' => 'update medicine', 'guard_name' => 'api'],
            ['name' => 'delete medicine', 'guard_name' => 'api'],
            ['name' => 'add address', 'guard_name' => 'api'],
            ['name' => 'update address', 'guard_name' => 'api'],
            ['name' => 'delete address', 'guard_name' => 'api'],
            ['name' => 'add work_time', 'guard_name' => 'api'],
            ['name' => 'update work_time', 'guard_name' => 'api'],
            ['name' => 'delete work_time', 'guard_name' => 'api'],
            ['name' => 'add component', 'guard_name' => 'api'],
            ['name' => 'update component', 'guard_name' => 'api'],
            ['name' => 'delete component', 'guard_name' => 'api'],
            ['name' => 'add material', 'guard_name' => 'api'],
            ['name' => 'update material', 'guard_name' => 'api'],
            ['name' => 'delete material', 'guard_name' => 'api'],
            //user
            ['name' => 'add reservation', 'guard_name' => 'api'],
            ['name' => 'delete reservation', 'guard_name' => 'api'],
            ['name' => 'add prescription', 'guard_name' => 'api'],
            ['name' => 'delete prescription', 'guard_name' => 'api'],
        ]);
    }
}
