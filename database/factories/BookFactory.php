<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\Shelf;
use App\User;

use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => $faker->text(20),
        'slug' =>$faker->slug(),
        'description' => $faker->text(35) ,
        'shelf_id' =>  Shelf::all()->random()->id,
        'created_by' =>  User::all()->random()->id,
        'status' => $faker->boolean(),
        'image_id' => 3
    ];
});
