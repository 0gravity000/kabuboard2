<?php

namespace App\Http\Controllers;

use App\Models\DailyPrice;
use Illuminate\Http\Request;

use App\Models\Stock;
use App\Models\Market;
use App\Models\Industry;
use Goutte;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\SignalDailyPrice;

class DailyPriceController extends Controller
{

    public function debug()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dailyprices = DailyPrice::all();
        $uniquedDates = $dailyprices->unique('date');   //キャメルケースOK、スネークケース、パスカルケースNG
        //dd($uniquedDates);
        $dailyprices = DailyPrice::paginate(100);
        return view('dailyprice', compact('dailyprices','uniquedDates'));
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
     * @param  \App\Models\DailyPrice
     * @return \Illuminate\Http\Response
     */
    public function show_code()
    {
        //
        //dd(request()->searchtext);
        //dd(request());
        $dailyprices = DailyPrice::all();
        $uniquedDates = $dailyprices->unique('date');   //キャメルケースOK、スネークケース、パスカルケースNG
        //dd($uniquedDates);
        if (DB::table('stocks')->where('code', request()->searchtext)->exists()) {
            $stock = Stock::where('code', request()->searchtext)->first();
            $dailyprices = DailyPrice::where('stock_id', $stock->id)->paginate(100);
            //dd($dailyprices);
            session()->flash('flash_message', '');
        } elseif(request()->searchtext == null) {
            session()->flash('flash_message', '');
            return redirect('/dailyprice');
        } else {
            session()->flash('flash_message', '該当コードはありません。');
            return redirect('/dailyprice');
        }
        return view('dailyprice', compact('dailyprices','uniquedDates'));
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
