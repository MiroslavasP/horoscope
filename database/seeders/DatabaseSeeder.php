<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_EN');

        for ($k = 1; $k <= 5; $k++) {
            for ($i = 1; $i <= 12; $i++) {
                for ($j = 1; $j <= 10; $j++) {

                    DB::table('day_descriptions')->insert([
                        'score' => $j,
                        'zodiac_id' => $i,
                        'day_about' => $faker->realText(rand(10, 30), 1),
                    ]);
                }
            }
        }

        $years = ['2022', '2023'];

        foreach ($years as $year) {

            DB::table('years')->insert([
                'year' => $year,

            ]);
        }

        $zodiacs = [
            'Aries', 'Taurus', 'Gemini',
            'Cancer', 'Leo', 'Virgo', 'Libra',
            'Scorpio', 'Sagittarius', 'Capricorn',
            'Aquarius', 'Pisces'
        ];

        foreach ($zodiacs as $zodiac) {

            DB::table('zodiacs')->insert([
                'title' => $zodiac,
                'starting_date' => 'Start at:',
                'end_date' => 'End at:',
                'zodiac_about' => 'Information will be available soon'

            ]);
        }

        foreach ($years as $year) {
            $zodiacIds = range(1, 12);
            foreach ($zodiacIds as $zodiacId) {
                $months = range(1, 12);
                foreach ($months as $month) {
                    if ($month == 2) {
                        $days = range(1, 28);
                    } elseif ($month == 4 || $month == 6 || $month == 9 || $month == 11) {
                        $days = range(1, 30);
                    } else {
                        $days = range(1, 31);
                    }
                    $scores = '';
                    foreach ($days as $key => $day) {
                        $dayScore = rand(1, 10);
                        $days[$key] = $dayScore;

                        $scores .= $dayScore . ',';
                    }
                    $scores = rtrim($scores, ", ");
                    $days = array_filter($days);
                    $average = round(array_sum($days) / count($days), 2);

                    DB::table('zodiac_calendars')->insert([
                        'year' => $year,
                        'zodiacs_id' => $zodiacId,
                        'month' => $month,
                        'scores' => $scores,
                        'average' => $average

                    ]);
                }
            }
        }
    }
}
