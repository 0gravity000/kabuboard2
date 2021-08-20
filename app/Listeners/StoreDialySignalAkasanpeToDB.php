<?php

namespace App\Listeners;

use App\Events\DialySignalAkasanpeCheck;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\DailyPrice;
use App\Models\Stock;
use App\Models\SignalDailyPrice;

class StoreDialySignalAkasanpeToDB
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DialySignalAkasanpeCheck  $event
     * @return void
     */
    public function handle(DialySignalAkasanpeCheck $event)
    {
        //当日 15:00-23:59の間にDialySignalAkasanpeCheckタスクスケジュールする
        //daily_pricesテーブルの任意の銘柄を更新日の降順で取得
        //daily_pricesテーブルに存在する日付の直近日で比較する
        $date = DailyPrice::where('stock_id', "1") //何でもいいので1にする
                            ->orderBy('updated_at', 'desc')
                            ->first();
        //dd($date);  //レコードに存在する直近の日付
        $now = $date->updated_at;

        //全銘柄のカウント
        $count = Stock::all()->count();
        //dd($count);
        //全銘柄分ループ
        for ($idx=0; $idx < $count; $idx++) { 
            $stock = Stock::find($idx+1);
            //dd($stock);
            if (DailyPrice::where('stock_id', $stock->id)->orderBy('updated_at', 'desc')->doesntExist()) { //存在チェック
                //dd('doesnt exsist :'.$stock->id );
                continue;
            }
            $dailyprices = DailyPrice::where('stock_id', $stock->id)->orderBy('updated_at', 'desc')->get();
            //dd($dailyprices[0]);
            //赤三兵チェック 3日連続陽線
            if ($dailyprices[0]->price > $dailyprices[1]->price) {
                if ($dailyprices[1]->price > $dailyprices[2]->price) {
                    if ($dailyprices[2]->price > $dailyprices[3]->price) {
                        //dd($dailyprices[0]->stock_id.':'.$dailyprices[0]->price.'<-'.$dailyprices[1]->price.'<-'.$dailyprices[2]->price.'<-'.$dailyprices[3]->price);
                        //signal_daily_pricesテーブルに格納
                        $signaldailyprice = new SignalDailyPrice;
                        $signaldailyprice->daily_price_id = $dailyprices[0]->id;
                        $signaldailyprice->signal_id = 1;
                        $signaldailyprice->save();
                    }
                }
            }
        }   //全銘柄分ループ

    }
}
