<?php

use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->insert([
        	'id' => 1,
            'theme_name' => 'modelo-1',
            'theme_description' => 'MODELO 1',
        ]);

        DB::table('themes')->insert([
        	'id' => 2,
            'theme_name' => 'modelo-2',
            'theme_description' => 'MODELO 2',
        ]);

        DB::table('themes')->insert([
        	'id' => 3,
            'theme_name' => 'modelo-3',
            'theme_description' => 'MODELO 3',
        ]);
    }
}
