<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Filters2026Seeder extends Seeder
{
    /**
     * Seeds the database with the filters of the 2026 works.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->upsert([
            ['slug' => 'quartier-des-grottes', 'name' => 'Quartier des Grottes'],
            ['slug' => 'place-des-nations', 'name' => 'Place des Nations'],
        ], ['slug'], ['name']);

        DB::table('professors')->upsert([
            ['slug' => 'celine-guibat', 'name' => 'Céline Guibat'],
            ['slug' => 'christian-dupraz', 'name' => 'Christian Dupraz'],
            ['slug' => 'florinel-radu', 'name' => 'Florinel Radu'],
            ['slug' => 'gotz-menzel', 'name' => 'Götz Menzel'],
            ['slug' => 'hani-buri', 'name' => 'Hani Buri'],
            ['slug' => 'isabel-concheiro', 'name' => 'Isabel Concheiro'],
            ['slug' => 'katrien-vertenten', 'name' => 'Katrien Vertenten'],
            ['slug' => 'stephanie-bender', 'name' => 'Stephanie Bender'],
            ['slug' => 'veronique-favre', 'name' => 'Véronique Favre'],
        ], ['slug'], ['name']);

        DB::table('workshops')->upsert([
            ['slug' => 'lacroix-chessex', 'name' => 'Lacroix-Chessex'],
            ['slug' => 'boegli-kramp', 'name' => 'Boegli-Kramp'],
            ['slug' => 'gloor-gonzalo', 'name' => 'Gloor-Gonzalo'],
        ], ['slug'], ['name']);
    }
}
