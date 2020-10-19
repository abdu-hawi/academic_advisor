<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Collect\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    $u = [27,9];
    do{
        $from = $u[rand(0,1)];
        $to = $u[rand(0,1)];
        $isRead = rand(0,1);
    }while($from === $to);
    return [
        'from'=>$from,
        'to'=>$to,
        'message'=>$faker->sentence,
        'isRead'=>$isRead
    ];
});
