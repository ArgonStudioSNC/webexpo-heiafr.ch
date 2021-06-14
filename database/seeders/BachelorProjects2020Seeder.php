<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Student;
use App\Models\Site;
use App\Models\Professor;
use App\Models\Workshop;

class BachelorProjects2020Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line('Started the seeding!');

        // Cleaning DB
        $this->command->line('Cleaning the database from old projects...');
        $projects = Project::where('year', 2020)->where('degree', 'bachelor')->get();
        foreach ($projects as $project) {
            $project->delete();
        }
        $this->command->line('Success!');

        // Loading .csv
        $this->command->line('Loading the csv file...');
        $csv_path = storage_path('app/seed/bachelor2020.csv');

        // Reading file
        $file = fopen($csv_path,"r");
        $all_data = array();
        $i = 0;
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($filedata );

            // Skip first rows
            if($i == 0){
                $i++;
                continue;
            }
            for ($c=0; $c < $num; $c++) {
                $all_data[$i][] = $filedata [$c];
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
            if (!$student) {
                $student = Student::create([
                    'uuid' => $uuid,
                    'first_name' => $entry[1],
                    'last_name' => $entry[0],
                ]);
            }
            $site = Site::firstWhere('slug', $entry[7]);
            $professor = Professor::firstWhere('slug', $entry[8]);
            $workshop = Workshop::firstWhere('slug', $entry[9]);

            $project = Project::create([
                'degree' => $entry[2],
                'year' => '2020',
                'student_id' => $student->id,
                'site_id' => $site ? $site->id : null,
                'professor_id' => $professor ? $professor->id : null,
                'workshop_id' => $workshop ? $workshop->id : null,
                'experts' => explode(';', $entry[3]),
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
        $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                                    'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                                    'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                                    'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                                    'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'U'=>'UE', 'ü'=>'ue' );

        $formated_lastname = str_replace(array('-', ' ', '.', '_', '’'), '', strtolower(strtr($lastname, $unwanted_array)));
        $formated_firstname = str_replace(array('-', ' ', '.', '_', '’'), '', strtolower(strtr($firstname, $unwanted_array)));

        return $formated_lastname.'-'. $formated_firstname;
    }
}
