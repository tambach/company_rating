<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' =>$faker->text(30),
        'address' => $faker->address(200),
        'phone' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'category_id' => $faker->numberBetween($min = 1, $max = 7),
        'image' => $faker->image('public/storage/images',640,480, null, false),

    ];
});
