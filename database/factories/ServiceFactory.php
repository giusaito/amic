<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Http\Models\Service;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'slug' => $faker->slug,
        'description' => $faker->text(100),
        'path' => $faker->url,
        'image' => $faker->url,
        'content' => $faker->text(500),
        'desc_form_contact' => $faker->title,
        'email_to' => $faker->email
    ];
});
