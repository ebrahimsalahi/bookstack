<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use App\BookComment;
use App\Book;
use App\User;
$factory->define(BookComment::class, function (Faker $faker) {
    return [
        'book_id' => Book::all()->random()->id,
        'user_id' => User::all()->random()->id,
        'comment' => $faker->text(40),
        'status' => $faker->boolean()
    ];
});
