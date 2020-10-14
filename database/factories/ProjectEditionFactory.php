<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\ProjectEdition;
use Faker\Generator as Faker;

$factory->define(ProjectEdition::class, function (Faker $faker) {
    return [
        'project_id' => $faker->numberBetween(1,2),
        'logo' => $faker->randomElement(['https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg', 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg', 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg', 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg']),
        'description' => $faker->text(100),
        'starring_photo' => $faker->randomElement(['https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg', 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg', 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg', 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg']),
        'date_event' => $faker->dateTime($max = 'now', $timezone = null),
        'date_event_finish' => $faker->dateTime($max = 'now', $timezone = null),
        'author_id' => $faker->numberBetween(1,2),
    ];
});
