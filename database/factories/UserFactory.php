<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {


    return [
        'id' => DB::table('users')->orderBy('id', 'desc')->first()->id + 1 ,
        'name' => $faker->name,
        'mobile' =>$faker->numerify('###########'),
        'email' => $faker->unique()->safeEmail,
        'is_active' => $faker->boolean(),
        'about' => $faker->text(35),
        'province_id' => 1,
        'edu_id' => 1,
        'skills'=> $faker->text(10) . ',' . $faker->text(10) ,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(20),
    ];

});
