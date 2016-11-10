<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

    $factory->define(App\Models\Ver1\User::class, function (Faker\Generator $faker) {
        return [
            'browser_name' => $faker->userAgent,
            'count_positiv' => 0,
            'count_negativ' => 0,
            'user_key' => uniqid('', true),
        ];
    });

    $factory->define(App\Models\Ver1\Content::class, function (Faker\Generator $faker) {
        return [
            'content' => $faker->paragraph,
            'js_files' => $faker->paragraph,
            'analysed' => 0,
            'safe' => 0
        ];
    });

    $factory->define(App\Models\Ver1\Url::class, function (Faker\Generator $faker) {
        return [
            'url' => $faker->url,
            'user_id' => 1,
            'safe' => $faker->boolean
        ];
    });
