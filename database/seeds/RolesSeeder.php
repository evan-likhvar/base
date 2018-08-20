<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id'=>1,
            'name' => 'Super_admin',
            'active' => 1,
        ]);

        DB::table('roles')->insert([
            'id'=>2,
            'name' => 'Admin',
            'active' => 0,
        ]);

        DB::table('roles')->insert([
            'id'=>3,
            'name' => 'Manager',
            'active' => 0,
        ]);

        DB::table('roles')->insert([
            'id'=>4,
            'name' => 'Guest',
            'active' => 0,
        ]);
    }
}
