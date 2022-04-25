<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'username' => 'admin33',
            'email' => 'admin33@gmail.com',
            'password' => Hash::make('00000000'),
            'imagePath'=>'OpI7f8njcHKJ5p4gPMEz2r8N2foufyTev5Q9elc2.jpg'
        ]);
    }
}
