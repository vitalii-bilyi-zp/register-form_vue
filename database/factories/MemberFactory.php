<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Member;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;


$factory->define(Member::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName(),
        'lastname' => $faker->lastName,
        'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'report' => $faker->sentence(rand(3, 8), true),
        'country_id' => DB::table('countries')->inRandomOrder()->first()->id,
        'phone' => $faker->numerify('+1 (###) ###-####'),
        'email' => $faker->unique()->safeEmail,
        'company' => $faker->company,
        'position' => $faker->jobTitle,
        'about' => $faker->text(500),
    ];
});
