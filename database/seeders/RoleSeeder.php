<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Super Admin',
            'code' => 'SUP01',
            'description'=>'Can create all users and generates new codes',

        ]);

        DB::table('roles')->insert([
            'name' => 'Admin',
            'code' => 'ADM01',
            'description'=>'Creates users and downloads new codes',

        ]);
    }
}
