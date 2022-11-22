<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Chapter;
use App\Book;
use Faker\Generator as Faker;

$factory->define(Chapter::class, function (Faker $faker) {
    return [
        'book_id' =>    Book::all()->random()->id ,
        'name' => $faker->text(20),
        'slug' =>$faker->slug(),
        'description' => $faker->text(35) ,
        'status' => $faker->boolean()
    ];

});
