<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Project;
use App\Model\Student;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {

    $sites = App\Model\Site::all()->pluck('id')->toArray();
    $workshop = App\Model\Workshop::all()->pluck('id')->toArray();
    $professor = App\Model\Professor::all()->pluck('id')->toArray();

    return [
        'degree' => $faker->randomElement(['bachelor' ,'master']),
        'year' => '2020',
        'student_id' => factory(Student::class)->create()->id,
        'site_id' => $faker->randomElement($sites),
        'professor_id' => $faker->randomElement($professor),
        'workshop_id' => $faker->randomElement($workshop),
        'experts' => [$faker->name, $faker->name],
        'title' => $faker->words($nb = 5, $asText = true),
        'lead' => $faker->sentence($nbWords = 14, $variableNbWords = true),
        'text' => $faker->text($maxNbChars = 800) ,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});

$factory->define(Student::class, function (Faker $faker) {
    return [
        'uuid' => 'diogo.dossantos' . $faker->unique()->randomNumber($nbDigits = 2),
        'first_name' => 'Diogo',
        'last_name' => 'Dos Santos',
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
