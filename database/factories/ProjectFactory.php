<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'logo' => $faker->image('public/storage/images/projects/logo',200,200, null, false),
        'author_id' => $faker->numberBetween(1,2),
        'status' => $faker->randomElement(['TRUE', 'FALSE']),
    ];
});
