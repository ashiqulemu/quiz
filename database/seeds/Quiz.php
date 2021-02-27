<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;



class Quiz extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =Faker::create();

            $quiz = DB::table('quizzes')->insertGetId([
                'quiz' => 'Default',
                'status'=>0,
                'expiry_date'=>$faker->dateTime($max = 'now', $timezone = null),
                'admin_id' => 1,
            ]);
        }

}
