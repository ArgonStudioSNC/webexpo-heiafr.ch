<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Filters2025Seeder extends Seeder
{
    /**
     * Seeds the database with the filters of the 2025 works.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->upsert([
            ['slug' => 'rte-de-la-fonderie', 'name' => "Rte de la Fonderie"],
            ['slug' => 'pisciculture-3', 'name' => "Pisciculture 3"],
            ['slug' => 'planche-inferieure', 'name' => "Planche Inférieure"],
        ], ['slug'], ['name']);

        DB::table('professors')->upsert([
            ['slug' => 'gotz-menzel', 'name' => 'Götz Menzel'],
            ['slug' => 'florinel-radu', 'name' => 'Florinel Radu'],
            ['slug' => 'hani-buri', 'name' => 'Hani Buri'],
            ['slug' => 'stephanie-bender', 'name' => 'Stephanie Bender'],
            ['slug' => 'christian-dupraz', 'name' => 'Christian Dupraz'],
            ['slug' => 'sonia-curnier', 'name' => 'Sonia Curnier'],
            ['slug' => 'serena-vanbutsele', 'name' => 'Séréna Vanbutsele'],
        ], ['slug'], ['name']);

        DB::table('workshops')->upsert([
            ['slug' => 'lacroix-chessex', 'name' => 'Lacroix-Chessex'],
            ['slug' => 'boegli-kramp', 'name' => 'Boegli-Kramp'],
            ['slug' => 'gloor-gonzalo', 'name' => 'Gloor-Gonzalo'],
        ], ['slug'], ['name']);
    }
}
