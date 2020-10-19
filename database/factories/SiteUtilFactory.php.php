<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Http\Models\SiteUtil;
use App\Http\Models\CategorySiteUtil;

$factory->define(SiteUtil::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'slug' => $faker->slug,
        'description' => $faker->text(100),
        'url' => $faker->url,
        'status' => 'PUBLISHED',
        'author_id' => 2,
        'published_at' => $faker->dateTime($max = 'now', $timezone = null),
    ];
});


$factory->define(CategorySiteUtil::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'slug' => $faker->slug,
        'description' => $faker->text(100),
    ];
});
