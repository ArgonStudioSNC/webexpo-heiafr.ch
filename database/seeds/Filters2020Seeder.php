<?php

use Illuminate\Database\Seeder;

class Filters2020Seeder extends Seeder
{
    /**
     * Seeds the database with the filters of the 2020 works.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->insert([
            ['slug' => 'fribourg','name' => 'Fribourg',],
            ['slug' => 'thun','name' => 'Thun',],
            ['slug' => 'berne','name' => 'Berne',],
            ['slug' => 'swiss','name' => 'Suisse',],
            ['slug' => 'europe','name' => 'Europe',],
            ['slug' => 'world','name' => 'reste du monde',],
        ]);

        DB::table('professors')->insert([
            ['slug' => 'gotz-menzel','name' => 'Gotz Menzel',],
            ['slug' => 'frederic-frank','name' => 'Frédéric Frank',],
            ['slug' => 'florinel-radu','name' => 'Florinel Radu',],
        ]);

        DB::table('workshops')->insert([
            ['slug' => 'lacroix-chessex','name' => 'Lacroix-Chessex',],
            ['slug' => 'gloor-buchhofer','name' => 'Gloor-Buchhofer',],
            ['slug' => 'boegli-kramp','name' => 'Boegli-Kramp',],
        ]);
        //
    }
}
