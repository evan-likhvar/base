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

        $date = \Carbon\Carbon::now();//->toDateTimeString();


        DB::table('roles')->insert([
            'id'=>1,
            'name' => 'Super_admin',
            'active' => 1,
            'created_at' => $date->addDay(-10),
            'updated_at' => $date->addDay(-8),
        ]);

        DB::table('roles')->insert([
            'id'=>2,
            'name' => 'Admin',
            'active' => 0,
            'created_at' => $date->addDay(-10),
            'updated_at' => $date->addDay(-1),
        ]);

        DB::table('roles')->insert([
            'id'=>3,
            'name' => 'Manager',
            'active' => 0,
            'created_at' => $date->addDay(-10),
            'updated_at' => $date->addDay(-4),
        ]);

        DB::table('roles')->insert([
            'id'=>4,
            'name' => 'Guest',
            'active' => 0,
            'created_at' => $date->addDay(-10),
            'updated_at' => $date->addDay(-3),
        ]);
    }
}
