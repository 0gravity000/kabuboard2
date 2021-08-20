<?php

namespace App\Listeners;

use App\Events\DialySignalVolumeCheck;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\DailyVolume;
use App\Models\Stock;
use App\Models\SignalDailyVolume;

class StoreDialySignalVolumeToDB
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
     * @param  DialySignalVolumeCheck  $event
     * @return void
     */
    public function handle(DialySignalVolumeCheck $event)
    {
        //当日 15:00-23:59の間にDialySignalAkasanpeCheckタスクスケジュールする
        //daily_pricesテーブルの任意の銘柄を更新日の降順で取得
        //daily_pricesテーブルに存在する日付の直近日で比較する
        $date = DailyVolume::where('stock_id', "1") //何でもいいので1にする
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
            if (DailyVolume::where('stock_id', $stock->id)->orderBy('updated_at', 'desc')->doesntExist()) { //存在チェック
                //dd('doesnt exsist :'.$stock->id );
                continue;
            }
            $dailyvolumes = DailyVolume::where('stock_id', $stock->id)->orderBy('updated_at', 'desc')->get();
            //dd($dailyvolumes[0]);
            //出来高急騰チェック
            //前日より10倍以上増えたもの。ただし以下は除外
            //基準日または1営業日前の出来高が0のものは除外
            //

            if (floatval($dailyvolumes[0]->volume) == 0 || floatval($dailyvolumes[1]->volume) == 0) {
                //何もしない
                //dd($dailyvolumes[0]);
            } else {
                if ((floatval($dailyvolumes[0]->volume) / floatval($dailyvolumes[1]->volume)) > 10) {
                    //dd($dailyvolumes[0]->stock_id.':'.$dailyvolumes[0]->volume.'/'.$dailyvolumes[1]->volume);
                    //signal_daily_volumesテーブルに格納
                    $signaldailyvolume = new SignalDailyVolume;
                    $signaldailyvolume->daily_volume_id = $dailyvolumes[0]->id;
                    $signaldailyvolume->signal_id = 3;
                    $signaldailyvolume->save();
                }
            }
        }   //全銘柄分ループ

    }
}
