<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shops\Shop;
use Faker\Generator as Faker;

$factory->define(Shop::class, function (Faker $faker) {
    return [
        'nom' => $faker->name,
        'adresse' => $faker->streetName,
        'numRue' => random_int(1, 99),
        'cp' => $faker->postcode,
        'lat' => random_int(41,51),
        'lng' => random_int(-6,10),
        'descriptif' => $faker->text,
        'tel' => $faker->numerify('##########'),
        'prefixeTel' => '+33',
        'email' => $faker->email,
        'siret' => $faker->numerify('##############'),
        'horaires' => '[lundi][mardi][mercredi][jeudi][vendredi][samedi][dimanche][ferié]',
        'etat' => random_int(1, 2),
        'codeNote' => $faker->numerify('##########'),
        'user_id' => factory(App\User::class),
        'city_id' => 1001,
        'subcategory_id' => random_int(1,6),
        'category_id' => random_int(1,7),

        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
});
