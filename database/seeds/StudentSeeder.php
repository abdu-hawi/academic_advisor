<?php


use App\Model\Collect\Advisor;
use App\Model\Collect\Student;
use App\Model\UserCollect;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=49 ; $i < 96 ; $i++){
            $collect = UserCollect::create([
                'type'=>'student'
            ]);
            Student::create([
                'id'=>$collect->id,
                'name'=>$faker->firstName.''.$faker->lastName,
                'password'=>'$2y$10$TMOR8yasvtwR4kkpj0IZZua7fFMow/RHUSeTSAWAWpHpRpviHaTGO',
                'email'=>$faker->email,
                'phone'=>$faker->phoneNumber,
                'gpa'=>rand(0,4).'.'.rand(00,99),
                'interest_id'=>rand(4,7),
                'num_course'=>rand(3,4),
                'has_plane'=>false,
                'email_verified_at'=>$faker->dateTime,
            ]);
            $advisor = Advisor::query()->orderBy('number_of_student', 'asc')->first();
            Student::where('id',$collect->id)->update([
                'advisor_id'=>$advisor->id
            ]);
            Advisor::where('id',$advisor->id)->update([
                'number_of_student'=>$advisor->number_of_student + 1
            ]);
        }
    }
}
