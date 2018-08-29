<?php

use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = \Carbon\Carbon::now()->toDateTimeString();

        DB::table('languages')->insert([
            'id'=>1,
            'name' => 'en',
            'full_name' => 'english',
            'active' => 1,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::table('languages')->insert([
            'id'=>2,
            'name' => 'ru',
            'full_name' => 'Русский',
            'active' => 0,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
