<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = \Carbon\Carbon::now()->toDateTimeString();


        DB::table('users')->insert([
            'id'=>1,
            'name' => 'super_admin@test.test',
            'email' => 'super_admin@test.test',
            'password' => '$2y$10$AEYNxKpTkKE1HyYCTXz7CORHbT.V6D/GM2nptrkMtBagWVAE2c/ba',
            'language_id' => 1,
            'dashboard_enable'=>1,
            'active'=>1,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
        DB::table('users')->insert([
            'id'=>2,
            'name' => 'admin@test.test',
            'email' => 'admin@test.test',
            'password' => '$2y$10$Rjt2bXdyO0m5R0O5s83q2OvvGpjC0RIz8da1NA5I7ZZ8aPlM7n9Bi',
            'language_id' => 1,
            'dashboard_enable'=>0,
            'active'=>0,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
        DB::table('users')->insert([
            'id'=>3,
            'name' => 'manager@test.test',
            'email' => 'manager@test.test',
            'password' => '$2y$10$hNEVaICJ.vQdZPi55pCl4.GV8sn1GU8cBuRzII9ob3La4FG5KkuX6',
            'language_id' => 1,
            'dashboard_enable'=>0,
            'active'=>0,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
        DB::table('users')->insert([
            'id'=>4,
            'name' => 'guest@test.test',
            'email' => 'guest@test.test',
            'password' => '$2y$10$yndV/VzkRsZa1fauhcTG7.VlzfOVf7Bo9Z5YjndcPgcnmFjxya0r2',
            'language_id' => 1,
            'dashboard_enable'=>0,
            'active'=>0,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

    }
}
