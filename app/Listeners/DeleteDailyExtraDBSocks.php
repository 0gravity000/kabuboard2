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
        foreach ($daily_prices as $daily_price) {
            $daily_price->delete();

            //signal_daily_pricesテーブルのデータも合わせて要削除

        }
        //daily_volumes テーブルの余分なレコードを削除
        $daily_volumes = DailyVolume::where('date', '<', $branchday)->get();
        foreach ($daily_volumes as $daily_volume) {
            $daily_volume->delete();

            //signal_daily_volumesテーブルのデータも合わせて要削除

        }
        Log::info('finish ScrapingDailySocksToDB.php');
    }
}
