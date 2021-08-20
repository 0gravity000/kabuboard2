<?php

namespace App\Listeners;

use App\Events\DialyStocksCheck;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\DailyPrice;
use App\Models\DailyVolume;
use App\Models\Stock;
use App\Models\Market;
use App\Models\Industry;
use Goutte;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use DateTimeZone;
use App\Models\Holiday;
use Illuminate\Support\Facades\DB;

class ScrapingDailySocksToDB
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
     * @param  DialyStocksCheck  $event
     * @return void
     */
    public function handle(DialyStocksCheck $event)
    {
        //祝日かチェックする
        $now = Carbon::now(new DateTimeZone('Asia/Tokyo'));
        $fomatted_now = $now->format('Y-m-d');
        //dd($fomatted_now);
        if (DB::table('holidays')->where('holiday', $fomatted_now)->exists()) {
            # 何もせず終了
            return;
        }

        $stocks = Stock::all();
        //stocks分ループ
        foreach ($stocks as $stock) {
            $stockcode = $stock->code;
            $marketcode = $stock->market->code;

            $marketmark = '.T';
            if ($marketcode == 8 or $marketcode == 9) {
              $marketmark = '.S';
            }
            if ($marketcode == 10 or $marketcode == 11) {
              $marketmark = '.F';
            }
            if ($marketcode == 12 or $marketcode == 13 or $marketcode == 14) {
              $marketmark = '.N';
            }
            $html = 'https://finance.yahoo.co.jp/quote/'.$stockcode.$marketmark;
            //スクレイピング
            $crawler = Goutte::request('GET', $html);  //composer require weidner/goutte が必要 https://github.com/dweidner/laravel-goutte
            //要検討 URLが存在しない場合はどうなる?
            try {
            } catch (\Exception $e) {
            }

            //Log::info($html." ".$stockcode.":チェック");

            //毎分用データ取得
            //現在値
            //#root > main > div > div > div.XuqDlHPN > div:nth-child(2) > section._1zZriTjI._2l2sDX5w > div._1nb3c4wQ > header > div.nOmR5zWz > span > span > span
            $price = $crawler->filter('#root > main > div > div > div.XuqDlHPN > div:nth-child(2) > section._1zZriTjI._2l2sDX5w > div._1nb3c4wQ > header > div.nOmR5zWz > span > span > span')->each(function ($node) {  //戻り値は配列
                $price_temp = $node->text();
                return $price_temp;
            });
            //Log::debug($price);

            //日足用データ
            //前日終値
            //#detail > section._2Yx3YP9V._3v4W38Hq > div > ul > li:nth-child(1) > dl > dd > span._1fofaCjs._2aohzPlv._1DMRub9m > span > span
            $pre_end_price = $crawler->filter('#detail > section._2Yx3YP9V._3v4W38Hq > div > ul > li:nth-child(1) > dl > dd > span._1fofaCjs._2aohzPlv._1DMRub9m > span > span')->text();
            //Log::debug($pre_end_price);
            //始値
            //#detail > section._2Yx3YP9V._3v4W38Hq > div > ul > li:nth-child(2) > dl > dd > span._1fofaCjs._2aohzPlv._1DMRub9m > span > span  
            $start_price = $crawler->filter('#detail > section._2Yx3YP9V._3v4W38Hq > div > ul > li:nth-child(2) > dl > dd > span._1fofaCjs._2aohzPlv._1DMRub9m > span > span')->text();
            //Log::debug($start_price);
            //高値
            //#detail > section._2Yx3YP9V._3v4W38Hq > div > ul > li:nth-child(3) > dl > dd > span._1fofaCjs._2aohzPlv._1DMRub9m > span > span
            $highest_price = $crawler->filter('#detail > section._2Yx3YP9V._3v4W38Hq > div > ul > li:nth-child(3) > dl > dd > span._1fofaCjs._2aohzPlv._1DMRub9m > span > span')->text();
            //Log::debug($highest_price);
            //安値
            //#detail > section._2Yx3YP9V._3v4W38Hq > div > ul > li:nth-child(4) > dl > dd > span._1fofaCjs._2aohzPlv._1DMRub9m > span > span
            $lowest_price = $crawler->filter('#detail > section._2Yx3YP9V._3v4W38Hq > div > ul > li:nth-child(4) > dl > dd > span._1fofaCjs._2aohzPlv._1DMRub9m > span > span')->text();
            //Log::debug($lowest_price);
            //出来高
            //#detail > section._2Yx3YP9V._3v4W38Hq > div > ul > li:nth-child(5) > dl > dd > span._1fofaCjs._2aohzPlv._1DMRub9m > span > span._3rXWJKZF._11kV6f2G
            $volume = $crawler->filter('#detail > section._2Yx3YP9V._3v4W38Hq > div > ul > li:nth-child(5) > dl > dd > span._1fofaCjs._2aohzPlv._1DMRub9m > span > span._3rXWJKZF._11kV6f2G')->text();
            //Log::debug($volume);

            //7:00-9:00はYahooサイトはメンテナンス状態で通常の値でなくなる(---)ためDB登録しないようにする
            try {
            } catch (\Exception $e) {
            }

            //DB登録 daily_stocksテーブル
            //同日のstock_idが存在していたら上書き、なければ新規作成
            $date = date('Y-m-d'); //当日中　15:00-23:59の間にこの処理を実行する
            $daily_stocks_buf = DailyPrice::updateOrCreate(
                ['stock_id' => $stock->id, 'date' => $date],
                [
                    'price' => floatval(str_replace(',','',$price[0])),
                    'pre_end_price' => floatval(str_replace(',','',$pre_end_price)),
                    'start_price' => floatval(str_replace(',','',$start_price)),
                    'end_price' => floatval(str_replace(',','',$price[0])),
                    'highest_price' => floatval(str_replace(',','',$highest_price)),
                    'lowest_price' => floatval(str_replace(',','',$lowest_price)),
                ]
            ); 

            //DB登録 daily_volumesテーブル
            $daily_volumes_buf = DailyVolume::updateOrCreate(
                ['stock_id' => $stock->id, 'date' => $date],
                [
                    'volume' => floatval(str_replace(',','',$volume)),
                ]
            ); 

        }   //stocks分ループ END
        Log::info('finish ScrapingDailySocksToDB.php');
    }
}
