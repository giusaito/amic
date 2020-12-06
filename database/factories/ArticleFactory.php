<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Http\Models\Article;   

$factory->define(Article::class, function (Faker $faker) {
	$storage = Storage::disk('public');
	$path = "storage/app/public/noticia/";
	$fak = $faker->image($path, 1200,380, null, false);
    return [
        'title' => $faker->sentence,
        'slug' => $faker->slug,
        'description' => $faker->sentence,
        'content' => $faker->paragraph($nbSentences = 100, $variableNbSentences = true),
        'status' =>'PUBLISHED',
        'path' => 'noticia/',
        'image' => '1200x380-' . $fak,
        'author_id' => '2',
        'template_id' => rand(1,3),
        'feature' => rand(0,1),
        'published_at' => $faker->dateTime($max = 'now', $timezone = null),
    ];
});
