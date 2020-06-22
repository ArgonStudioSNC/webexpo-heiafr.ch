<?php

use Illuminate\Database\Seeder;

class Filters2020BSeeder extends Seeder
{
    /**
     * Seeds the database with the filters of the 2020 works.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professors')->insert([
            ['slug' => 'eric-tilbury','name' => 'Éric Tilbury',],
            ['slug' => 'hani-buri','name' => 'Hani Buri',],
            ['slug' => 'stephanie-bender','name' => 'Stephanie Bender',],
        ]);
    }
}
