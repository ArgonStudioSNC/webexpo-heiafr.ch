<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(Filters2020Seeder::class);
        $this->call(Filters2021Seeder::class);
        $this->call(Filters2022Seeder::class);
        $this->call(Filters2023Seeder::class);
    }
}
