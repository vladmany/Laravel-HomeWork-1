<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->word,
        'author' => $faker->name,
        'year' => $faker->year,
        'preview_path' => 'storage/id/preview',
        'body_path' => 'storage/id/body'
    ];
});
