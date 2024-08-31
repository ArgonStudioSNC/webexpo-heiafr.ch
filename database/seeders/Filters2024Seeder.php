<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Filters2024Seeder extends Seeder
{
    /**
     * Seeds the database with the filters of the 2024 works.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->upsert([
            ['slug' => 'la-poya', 'name' => "La Poya"],
        ], ['slug'], ['name']);

        DB::table('professors')->upsert([
            ['slug' => 'gotz-menzel', 'name' => 'Götz Menzel'],
            ['slug' => 'eric-tilbury', 'name' => 'Eric Tilbury'],
            ['slug' => 'florinel-radu', 'name' => 'Florinel Radu'],
            ['slug' => 'hani-buri', 'name' => 'Hani Buri'],
            ['slug' => 'stephanie-bender', 'name' => 'Stephanie Bender'],
            ['slug' => 'tanya-zein', 'name' => 'Tanya Zein'],
            ['slug' => 'isabel-concheiro', 'name' => 'Isabel Concheiro'],
            ['slug' => 'christian-dupraz', 'name' => 'Christian Dupraz'],
        ], ['slug'], ['name']);

        DB::table('workshops')->upsert([
            ['slug' => 'lacroix-chessex', 'name' => 'Lacroix-Chessex'],
            ['slug' => 'boegli-kramp', 'name' => 'Boegli-Kramp'],
            ['slug' => 'blaettler-dafflon', 'name' => 'Blättler-Dafflon'],
            ['slug' => 'gloor-nay', 'name' => 'Gloor-Nay'],
        ], ['slug'], ['name']);
    }
}
