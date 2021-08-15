<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\DailyVolume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyVolumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dailyvolumes = DailyVolume::all();
        $uniquedDates = $dailyvolumes->unique('date');   //キャメルケースOK、スネークケース、パスカルケースNG
        //dd($uniquedDates);
        $dailyvolumes = DailyVolume::paginate(100);
        return view('dailyvolume', compact('dailyvolumes','uniquedDates'));
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
    public function show_code()
    {
        //
        //dd(request()->searchtext);
        //dd(request());
        $dailyvolumes = DailyVolume::all();
        $uniquedDates = $dailyvolumes->unique('date');   //キャメルケースOK、スネークケース、パスカルケースNG
        //dd($uniquedDates);
        if (DB::table('stocks')->where('code', request()->searchtext)->exists()) {
            $stock = Stock::where('code', request()->searchtext)->first();
            $dailyvolumes = DailyVolume::where('stock_id', $stock->id)->paginate(100);
            //dd($dailyvolumes);
            session()->flash('flash_message', '');
        } elseif(request()->searchtext == null) {
            session()->flash('flash_message', '');
            return redirect('/dailyvolume');
        } else {
            session()->flash('flash_message', '該当コードはありません。');
            return redirect('/dailyvolume');
        }
        return view('dailyvolume', compact('dailyvolumes','uniquedDates'));
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
