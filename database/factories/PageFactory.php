<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Page;
use App\Chapter;
use App\Book;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'book_id' => Book::all()->random()->id,
        'chapter_id' => Chapter::all()->random()->id,
        'name' => $faker->text(20),
        'slug' =>$faker->slug(),
        'text' => $faker->text(200) ,
        'status' => $faker->boolean()
    ];
});
