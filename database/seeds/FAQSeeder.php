<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Model\Admin\FAQ;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0 ; $i < 100 ; $i++){

            FAQ::create([
                'question'=>$faker->text,
                'answer'=>$faker->paragraph
            ]);
        }
    }
}
