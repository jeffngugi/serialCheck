<?php

namespace Database\Seeders;

use DB;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Geoffrey Mwathi',
            'email' => 'jeff@mail.com',
            'password' => Hash::make('password'),
            'username'=>'jeff',
            'role_id'=>1,
            'created_at'=>Carbon::now()

        ]);
    }
}
