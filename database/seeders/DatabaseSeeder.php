<?php

use Database\Seeders\CitySeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleHasPermission;
use Database\Seeders\RoleSeeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WorkTimesSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleHasPermission::class);
        $this->call(UserSeeder::class);
        $this->call(WorkTimesSeeder::class);
        $this->call(StateSeeder::class);
        //$this->call(AreaSeeder::class);
        $this->call(CitySeeder::class);

    }
}
