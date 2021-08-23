<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SignalDailyPrice;
use App\Models\SignalDailyVolume;
use App\Models\Stock;

use App\Models\DailyPrice;
use App\Models\DailyVolume;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Log;

class SignalController extends Controller
{
    public function debug()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_akasan()
    {
        //
        //$stocks = Stock::where('id', 1)->get();
        //dd($stocks);
        $signalakasans = SignalDailyPrice::where('signal_id', 1)->get();
        $plucked = $signalakasans->pluck('daily_price_id');
        //dd($$plucked);
        $dailyprices = DailyPrice::whereIn('id', $plucked)->orderBy('date', 'desc')->get();
        //dd($dailyprices);
        return view('signalakasan', compact('dailyprices'));
    }

    public function index_kurosan()
    {
        //
        //$stocks = Stock::where('id', 1)->get();
        //dd($stocks);
        $signalkurosans = SignalDailyPrice::where('signal_id', 2)->get();
        $plucked = $signalkurosans->pluck('daily_price_id');
        $dailyprices = DailyPrice::whereIn('id', $plucked)->orderBy('date', 'desc')->get();
        return view('signalkurosan', compact('dailyprices'));
    }
    public function index_volume()
    {
        //
        //$stocks = Stock::where('id', 1)->get();
        //dd($stocks);
        $signalvolumes = SignalDailyVolume::where('signal_id', 3)->get();
        $plucked = $signalvolumes->pluck('daily_volume_id');
        $dailyvolumes = DailyVolume::whereIn('id', $plucked)->orderBy('date', 'desc')->get();
        return view('signalvolume', compact('dailyvolumes'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
