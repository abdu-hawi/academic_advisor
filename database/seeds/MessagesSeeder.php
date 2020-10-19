<?php

use App\Model\Collect\Advisor;
use App\Model\Collect\Message;
use App\Model\Collect\Student;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        $student = [27,90,67,74,56,82,60,52,49];
        for ($i=0;$i<748;$i++){
            $r_st = rand(0,8);
            $r = rand(0,1);// 0 advisor
            if ($r == 0){
                $from = 9;
                $to = $student[$r_st];
            }else{
                $to = 9;
                $from = $student[$r_st];
            }
            Message::create([
                'from'=>$from,
                'to'=>$to,
                'message'=>$faker->sentence,
                'isRead'=>rand(0,1)
            ]);
        }
    }
}
