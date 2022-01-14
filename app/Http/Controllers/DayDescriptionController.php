<?php

namespace App\Http\Controllers;

use App\Models\DayDescription;
use App\Models\Zodiac;
use App\Http\Requests\StoreDayDescriptionRequest;
use App\Http\Requests\UpdateDayDescriptionRequest;
use Illuminate\Http\Request;

class DayDescriptionController extends Controller
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
     * @param  \App\Http\Requests\StoreDayDescriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDayDescriptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DayDescription  $dayDescription
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = explode('/', $request->id);
        $dayDescription = DayDescription::where(['score' => $data[0], 'zodiac_id' => $data[1]])->get();
        $dayDescription = $dayDescription[rand(0, 4)];
        $zodiacTitle = Zodiac::select('title')->where('id', $data[1])->get()->first();


        return view('front.day_description', [
            'zodiacTitle' => $zodiacTitle,
            'dayDescription' => $dayDescription,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DayDescription  $dayDescription
     * @return \Illuminate\Http\Response
     */
    public function edit(DayDescription $dayDescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDayDescriptionRequest  $request
     * @param  \App\Models\DayDescription  $dayDescription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDayDescriptionRequest $request, DayDescription $dayDescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DayDescription  $dayDescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(DayDescription $dayDescription)
    {
        //
    }
}
