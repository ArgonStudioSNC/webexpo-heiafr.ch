<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Filters2023Seeder extends Seeder
{
    /**
     * Seeds the database with the filters of the 2023 works.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->upsert([
            ['slug' => 'mayens-de-l-ours', 'name' => "Les Mayens de l'Ours"],
            ['slug' => 'sion', 'name' => 'Sion'],
            ['slug' => 'thyon-2000', 'name' => 'Thyon 2000'],
        ], ['slug'], ['name']);

        DB::table('professors')->upsert([
            ['slug' => 'gotz-menzel', 'name' => 'Götz Menzel'],
            ['slug' => 'frederic-frank', 'name' => 'Frédéric Frank'],
            ['slug' => 'florinel-radu', 'name' => 'Florinel Radu'],
            ['slug' => 'hani-buri', 'name' => 'Hani Buri'],
            ['slug' => 'stephanie-bender', 'name' => 'Stephanie Bender'],
            ['slug' => 'tanya-zein', 'name' => 'Tanya Zein'],
        ], ['slug'], ['name']);

        DB::table('workshops')->upsert([
            ['slug' => 'lacroix-chessex', 'name' => 'Lacroix-Chessex'],
            ['slug' => 'gloor-petitpierre', 'name' => 'Gloor-Petitpierre'],
            ['slug' => 'boegli-kramp', 'name' => 'Boegli-Kramp'],
        ], ['slug'], ['name']);
    }
}
