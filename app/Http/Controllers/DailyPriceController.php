<?php

namespace App\Http\Controllers;

use App\Models\DailyPrice;
use Illuminate\Http\Request;

use App\Models\Stock;
use App\Models\Market;
use App\Models\Industry;
use Goutte;
use Illuminate\Support\Facades\Log;

class DailyPriceController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DailyPrice  $dailyPrice
     * @return \Illuminate\Http\Response
     */
    public function show(DailyPrice $dailyPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DailyPrice  $dailyPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyPrice $dailyPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DailyPrice  $dailyPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyPrice $dailyPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DailyPrice  $dailyPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(DailyPrice $dailyPrice)
    {
        //
    }
}
