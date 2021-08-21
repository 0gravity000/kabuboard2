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
        $daily_history = DailyPrice::orderBy('date', 'asc')->first();
        //現在
        $now = Carbon::now(new DateTimeZone('Asia/Tokyo'));
        //今日の日付
        $today = Carbon::create($now->year, $now->month, $now->day);
        //基準日の日付 10日分
        $branchday = $today;
        for ($i = 0; $i < 10; $i++) { 
            $branchday = $branchday->subDay();
        }

        //daily_prices テーブルの余分なレコードを削除
        $daily_prices = DailyPrice::where('date', '<', $branchday)->get();
        dd($daily_prices);
        foreach ($daily_prices as $daily_price) {
            //dd($daily_price);
            $signal_daily_prices = $daily_price->signal_daily_prices;
            //dd($signal_daily_prices);
            //dd($signal_daily_prices->isEmpty());

            //signal_daily_pricesテーブルのデータも合わせて要削除
            if ($signal_daily_prices->isEmpty()) { //存在チェック
                //何もしない
            } else {
                foreach ($signal_daily_prices as $signal_daily_price) {
                    //dd('Not Empty :'.$signal_daily_price);
                    $signal_daily_price->delete();
                }
            }   //signal_daily_pricesテーブル

            //daily_pricesテーブルのデータを削除
            $daily_price->delete();
        }   //daily_pricesテーブル

        //daily_volumes テーブルの余分なレコードを削除
        $daily_volumes = DailyVolume::where('date', '<', $branchday)->get();
        foreach ($daily_volumes as $daily_volume) {
            $signal_daily_volumes = $daily_volume->signal_daily_volumes;
            //signal_daily_volumesテーブルのデータも合わせて要削除
            if ($signal_daily_volumes->isEmpty()) { //存在チェック
                //何もしない
            } else {
                foreach ($signal_daily_volumes as $signal_daily_volume) {
                    //dd('Not Empty :'.$signal_daily_volume);
                    $signal_daily_volume->delete();
                }
            }   //signal_daily_volumesテーブル

            //daily_volumesテーブルのデータを削除
            $daily_volume->delete();
        }   //daily_volumesテーブル

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
        //dd($signalakasans);
        return view('signalakasan', compact('signalakasans'));
    }

    public function index_kurosan()
    {
        //
        //$stocks = Stock::where('id', 1)->get();
        //dd($stocks);
        $signalkurosans = SignalDailyPrice::where('signal_id', 2)->get();
        //dd($signalkurosans);
        return view('signalkurosan', compact('signalkurosans'));
    }
    public function index_volume()
    {
        //
        //$stocks = Stock::where('id', 1)->get();
        //dd($stocks);
        $signalvolumes = SignalDailyVolume::where('signal_id', 3)->get();
        //dd($signalvolumes);
        return view('signalvolume', compact('signalvolumes'));
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
