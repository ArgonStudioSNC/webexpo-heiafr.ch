<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class DemoProjectSeeder extends Seeder
{
    /**
     * Seeds the database with the demo projects of Diogo Dos Santos.
     *
     * @return void
     */
    public function run()
    {
        factory(Project::class, 20)->create();
    }
}
