<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Filters2021Seeder extends Seeder
{
    /**
     * Seeds the database with the filters of the 2020 works.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->insert([
            ['slug' => 'biel-bienne','name' => 'Biel/Bienne',],
            ['slug' => 'neuchatel','name' => 'Neuchâtel',],
            ['slug' => 'chaux-de-fonds','name' => 'La Chaux-de-Fonds',],
        ]);
        //
    }
}
