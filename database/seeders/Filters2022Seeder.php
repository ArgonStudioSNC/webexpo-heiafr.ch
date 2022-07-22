<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Filters2022Seeder extends Seeder
{
    /**
     * Seeds the database with the filters of the 2020 works.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->upsert([
            ['slug' => 'bale', 'name' => 'Bâle'],
            ['slug' => 'aarau', 'name' => 'Aarau'],
        ], ['slug'], ['name']);

        DB::table('professors')->upsert([
            ['slug' => 'gotz-menzel', 'name' => 'Götz Menzel'],
            ['slug' => 'frederic-frank', 'name' => 'Frédéric Frank'],
            ['slug' => 'florinel-radu', 'name' => 'Florinel Radu'],
            ['slug' => 'jonathan-parrat', 'name' => 'Jonathan Parrat'],
            ['slug' => 'hani-buri', 'name' => 'Hani Buri'],
            ['slug' => 'francois-esquivie', 'name' => 'François Esquivié'],
            ['slug' => 'stephanie-bender', 'name' => 'Stephanie Bender'],
            ['slug' => 'patricia-guaita', 'name' => 'Patricia Guaita'],
            ['slug' => 'tania-zein', 'name' => 'Tania Zein'],
            ['slug' => 'raffael-baur', 'name' => 'Raffael Baur'],
            ['slug' => 'serena-vanbutsele', 'name' => 'Séréna Vanbutsele'],
        ], ['slug'], ['name']);

        DB::table('workshops')->upsert([
            ['slug' => 'lacroix-chessex', 'name' => 'Lacroix-Chessex'],
            ['slug' => 'gloor-petitpierre', 'name' => 'Gloor-Petitpierre'],
            ['slug' => 'boegli-kramp', 'name' => 'Boegli-Kramp'],
            ['slug' => 'bertrand-mohring', 'name' => 'Bertrand-Möhring'],
        ], ['slug'], ['name']);
    }
}
