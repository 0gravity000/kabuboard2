<?php

namespace App\Listeners;

use App\Events\DialyExtraStocksCheck;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\DailyPrice;
use App\Models\DailyVolume;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Log;

class DeleteDailyExtraDBSocks
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
     * @param  DialyExtraStocksCheck  $event
     * @return void
     */
    public function handle(DialyExtraStocksCheck $event)
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
        //dd($daily_prices);
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
                    Log::info('delete id:'.$signal_daily_price->id.' daily_price_id:'.$signal_daily_price->daily_price_id);
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
                    Log::info('delete id:'.$signal_daily_volume->id.' daily_volume_id:'.$signal_daily_volume->daily_volume_id);
                    $signal_daily_volume->delete();
                }
            }   //signal_daily_volumesテーブル

            //daily_volumesテーブルのデータを削除
            $daily_volume->delete();
        }   //daily_volumesテーブル

        Log::info('finish ScrapingDailySocksToDB.php');
    }
}
