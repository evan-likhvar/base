<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'id'=>1,
            'name' => 'CAN_VIEW_DASHBOARD',
        ]);
        DB::table('permissions')->insert([
            'id'=>2,
            'name' => 'CAN_VIEW_USERS',
        ]);
        DB::table('permissions')->insert([
            'id'=>3,
            'name' => 'CAN_VIEW_USER',
        ]);
        DB::table('permissions')->insert([
            'id'=>4,
            'name' => 'CAN_EDIT_USER',
        ]);
        DB::table('permissions')->insert([
            'id'=>5,
            'name' => 'CAN_VIEW_ROLES',
        ]);
        DB::table('permissions')->insert([
            'id'=>6,
            'name' => 'CAN_VIEW_ROLE',
        ]);
        DB::table('permissions')->insert([
            'id'=>7,
            'name' => 'CAN_EDIT_ROLE',
        ]);
        DB::table('permissions')->insert([
            'id'=>8,
            'name' => 'CAN_VIEW_ROLES_PERMISSIONS',
        ]);
        DB::table('permissions')->insert([
            'id'=>9,
            'name' => 'CAN_EDIT_ROLES_PERMISSIONS',
        ]);
    }
}
