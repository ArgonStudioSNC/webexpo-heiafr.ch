<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Student;

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
