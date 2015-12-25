<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
        'email'          => $faker->email,
        'is_admin'       => false,
        'password'       => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Congregation::class, function (Faker\Generator $faker) {
    return [
        'name'              => $faker->city(),
        'is_group'          => false,
        'public_meeting_at' => Carbon\Carbon::create(null, null, rand(1, 20), rand(10, 19), rand(0, 1) * 30, 0),
    ];
});

$factory->define(App\Locale::class, function (Faker\Generator $faker) {
    $languageCode = $faker->languageCode();

    return [
        'code' => $languageCode,
        'name' => $languageCode,
    ];
});

$factory->define(App\Speaker::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name'  => $faker->lastName,
        'email'      => $faker->email,
    ];
});

$factory->define(App\Talk::class, function (Faker\Generator $faker) {
    return [
        'number' => $faker->numberBetween(1, 200),
    ];
});

$factory->define(App\TalkSubject::class, function (Faker\Generator $faker) {
    return [
        'subject' => $faker->sentence(8),
    ];
});

$factory->define(App\ScheduledTalk::class, function (Faker\Generator $faker) {
    $now = Carbon::now();
    $from = Carbon::create($now->year, $now->month, 1, 0, 0, 0, null);
    $to = $from->copy()->addMonth()->subSecond();

    return [
        'scheduled_at' => $faker->dateTimeBetween($from, $to),
    ];
});
