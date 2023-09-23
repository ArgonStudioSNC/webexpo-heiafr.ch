<?php

namespace Database\Seeders;

use App\Models\Professor;
use App\Models\Project;
use App\Models\Site;
use App\Models\Student;
use App\Models\Workshop;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * run with cmd : SEEDER_YEAR=<year> SEEDER_DEGREE=<degree> php artisan db:seed --class=ProjectsSeeder
     *
     * @return void
     */
    public function run()
    {
        $seederYear = env('SEEDER_YEAR', null);
        $seederDegree = env('SEEDER_DEGREE', null);

        if (is_null($seederYear)) {
            exit('Error: Please specify SEEDER_YEAR');
        }
        if (is_null($seederDegree)) {
            exit('Error: Please specify SEEDER_DEGREE');
        }

        $this->command->line('Started the seeding!');

        // Cleaning DB
        $this->command->line('Cleaning the database from old projects...');
        $projects = Project::where('year', $seederYear)->where('degree', $seederDegree)->get();
        foreach ($projects as $project) {
            $student = $project->student()->first();
            $project->delete();
            if (! is_null($student)) {
                $student->delete();
            }
        }
        $this->command->line('Success!');

        // Loading .csv
        $this->command->line('Loading the csv file...');
        $csv_path = storage_path('app/seed/'.$seederDegree.$seederYear.'.csv');

        // Reading file
        $file = fopen($csv_path, 'r');
        $all_data = [];
        $i = 0;
        while (($filedata = fgetcsv($file, 1000, ';')) !== false) {
            $num = count($filedata);

            // Skip first rows
            if ($i == 0) {
                $i++;
                continue;
            }
            for ($c = 0; $c < $num; $c++) {
                $all_data[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file);
        $this->command->line('Success!');

        // Filling DB with data
        $this->command->line('Filling the database with data...');

        foreach ($all_data as $entry) {
            $uuid = $this->formatUserUUID($entry[0], $entry[1]);
            $student = Student::where('uuid', $uuid)->first();
            if (! $student) {
                $student = Student::create([
                    'uuid' => $uuid,
                    'first_name' => $entry[1],
                    'last_name' => $entry[0],
                ]);
            }
            $this->command->line($student->uuid);

            $site = Site::firstWhere('slug', $entry[7]);
            $professor = Professor::firstWhere('slug', $entry[8]);
            $workshop = Workshop::firstWhere('slug', $entry[9]);

            $project = Project::create([
                'degree' => $entry[2],
                'year' => $seederYear,
                'student_id' => $student->id,
                'site_id' => $site ? $site->id : null,
                'professor_id' => $professor ? $professor->id : null,
                'workshop_id' => $workshop ? $workshop->id : null,
                'experts' => $entry[3] ? explode(';', $entry[3]) : null,
                'title' => $entry[4],
                'lead' => $entry[5],
                'text' => $entry[6],
            ]);
        }
        $this->command->line('Success!');

        $this->command->line('Seeding completed!');
    }

    public function formatUserUUID($lastname, $firstname)
    {
        $unwanted_array = ['Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
            'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'ae', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'oe', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ü' => 'ue', ];

        $formated_lastname = str_replace(['-', ' ', '.', '_', '’'], '', strtolower(strtr($lastname, $unwanted_array)));
        $formated_firstname = str_replace(['-', ' ', '.', '_', '’'], '', strtolower(strtr($firstname, $unwanted_array)));

        return $formated_lastname.'-'.$formated_firstname;
    }
}
