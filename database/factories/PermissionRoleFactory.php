<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\PermitRole;
use App\User;
use App\Role;
use App\RolePermit;

$factory->define(PermitRole::class, function (Faker $faker) {
    return [
        'permission_id' =>  RolePermit::all()->random()->id,
        'role_id' =>  Role::all()->random()->id
    ];
});
