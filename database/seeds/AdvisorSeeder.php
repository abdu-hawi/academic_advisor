<?php

use App\Model\Collect\Advisor;
use App\Model\UserCollect;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class AdvisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=39 ; $i < 49 ; $i++){
            $r_o_from = rand(00,59);
            $collect = UserCollect::create([
                'type'=>'advisor'
            ]);
            Advisor::create([
                'id'=>$collect->id,
                'name'=>$faker->firstName.''.$faker->lastName,
                'password'=>'$2y$10$TMOR8yasvtwR4kkpj0IZZua7fFMow/RHUSeTSAWAWpHpRpviHaTGO',
                'email'=>$faker->email,
                'phone'=>$faker->phoneNumber,
                'office_from'=>'08:'.$r_o_from,
                'office_to'=>'03:'.$r_o_from,
                'room_no'=>rand(413,422),
                'number_of_student'=>rand(0,9),
                'email_verified_at'=>$faker->dateTime,
            ]);
        }
    }
}
