<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<150;$i++){
            $score = mt_rand(251,499)/100;
            $course_id = rand(14,29);
            DB::table('scores')->insert([
                "course_id" => $course_id,
                "score" => $score
            ]);
        }
    }
}
/*
 SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 14;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 15;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 16;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 17;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 18;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 19;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 20;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 21;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 22;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 23;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 24;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 25;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 26;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 27;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 28;
SELECT AVG(`score`) FROM `scores` WHERE `course_id` = 29;
 */
