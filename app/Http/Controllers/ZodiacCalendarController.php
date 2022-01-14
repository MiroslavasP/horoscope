<?php

namespace App\Http\Controllers;

use App\Models\ZodiacCalendar;
use App\Models\Zodiac;
use Illuminate\Http\Request;
use App\Calendar\Calendar;
use App\Models\DayDescription;

class ZodiacCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ZodiacCalendar  $zodiacCalendar
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->year && $request->zodiac) {
            $allZodiacsAverages = [];
            $zodiacsYearAverageArray = [];
            $year = $request->year;
            $zodiacId = $request->zodiac;

            $zodiacInfo = Zodiac::where('id', $zodiacId)->get()->first();

            $months = range(1, 12);
            $zodiacs = range(1, 12);
            foreach ($zodiacs as $zodiac) {
                $mostSuccessfulZodiac = ZodiacCalendar::select('average')->where(['year' => $year, 'zodiacs_id' => $zodiac])->get();
                foreach ($mostSuccessfulZodiac as $m) {
                    $zodiacsYearAverageArray[] = $m->average;
                }
                $zodiacsYearAverage = round(array_sum($zodiacsYearAverageArray) / count($zodiacsYearAverageArray), 2);
                $allZodiacsAverages[] = $zodiacsYearAverage;
            }
            $maxValue = max($allZodiacsAverages);

            $bestZodiacId = array_search($maxValue, $allZodiacsAverages) + 1;

            $bestZodiacTitle = Zodiac::select('title')->where('id', $bestZodiacId)->get()->first();

            $calendars = [];

            foreach ($months as $month) {
                $data = ZodiacCalendar::where([
                    ['year', '=', $year],
                    ['zodiacs_id', '=', $zodiacId],
                ])->get();

                $averageArray = [];
                foreach ($data as $d) {
                    $averageArray[] = $d['average'];
                }

                $maxValue = max($averageArray);
                $bestMonth = array_search($maxValue, $averageArray) + 1;

                $scores = explode(',', $data[$month - 1]->scores);

                $calendar = new Calendar("$year-$month-01");
                foreach ($scores as $key => $score) {

                    $calendar->add_event('<a href="' . route('show_day_about') . '?id=' . $score . '/' . $zodiacId . '/' . $year . '">Score-' . $score . '</a>', $year . '-' . $month . '-' . $key + 1, 1, 'score' . $score);
                }

                $calendars[] = $calendar;
            }

            return view('front.show', [
                'calendars' => $calendars,
                'zodiac_info' => $zodiacInfo,
                'year' => $year,
                'best_month' => $bestMonth,
                'bestZodiacTitle' => $bestZodiacTitle,
            ]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ZodiacCalendar  $zodiacCalendar
     * @return \Illuminate\Http\Response
     */
    public function edit(ZodiacCalendar $zodiacCalendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateZodiacCalendarRequest  $request
     * @param  \App\Models\ZodiacCalendar  $zodiacCalendar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ZodiacCalendar $zodiacCalendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ZodiacCalendar  $zodiacCalendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZodiacCalendar $zodiacCalendar)
    {
        //
    }
}
