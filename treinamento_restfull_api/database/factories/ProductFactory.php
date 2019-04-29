<?php

use App\Product;
use App\User;
use Faker\Generator as Faker;

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

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1, 10),
        'status' => $faker->randomElements([Product::AVAILABLE_PRODUT, Product::UNAVAILABLE_PRODUT]),
        'image' => $faker->randomElements(['1.jpg','2.jpg','3.jpg']),
        'seller_id' => User::all()->random()->id,
        //User::inRandomOrder()->first()->id

    ];
});
