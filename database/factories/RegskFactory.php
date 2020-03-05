<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Regsk;
use Faker\Generator as Faker;

$factory->define(Regsk::class, function (Faker $faker) {
    return [
        'nama_sk' => $faker->name,
        'no_sk' => $faker->numberBetween($min = 1500, $max = 6000),
        'desc_sk' => $faker->sentence(10),
        'tgl_sk' => date('d m Y'),
        'bidang_sk' => Str::random(10),
        'ttd_sk' => $faker->name,
        'tahun' => date('Y'),
    ];
});
