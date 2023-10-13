<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'libelle' => 'Libelle',
        'description' => $faker->text,
        'reference' => '12345678901234567890',
        'prix' => random_int(1, 50),
        'shop_id' => random_int(1, 50),
        'unit_id' => random_int(1, 4),

        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
});
