<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Filters2020Seeder extends Seeder
{
    /**
     * Seeds the database with the filters of the 2020 works.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->upsert([
            ['slug' => 'fribourg', 'name' => 'Fribourg'],
            ['slug' => 'thun', 'name' => 'Thun'],
            ['slug' => 'bern', 'name' => 'Berne'],
        ], ['slug'], ['name']);

        DB::table('professors')->upsert([
            ['slug' => 'gotz-menzel', 'name' => 'Götz Menzel'],
            ['slug' => 'frederic-frank', 'name' => 'Frédéric Frank'],
            ['slug' => 'florinel-radu', 'name' => 'Florinel Radu'],
            ['slug' => 'eric-tilbury', 'name' => 'Éric Tilbury'],
            ['slug' => 'hani-buri', 'name' => 'Hani Buri'],
            ['slug' => 'stephanie-bender', 'name' => 'Stephanie Bender'],
        ], ['slug'], ['name']);

        DB::table('workshops')->upsert([
            ['slug' => 'lacroix-chessex', 'name' => 'Lacroix-Chessex'],
            ['slug' => 'gloor-buchhofer', 'name' => 'Gloor-Buchhofer'],
            ['slug' => 'boegli-kramp', 'name' => 'Boegli-Kramp'],
        ], ['slug'], ['name']);
    }
}
