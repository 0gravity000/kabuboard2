<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Events\DialyMeigarasCheck;
use App\Events\DialyStocksCheck;
use App\Events\DialyExtraStocksCheck;
use App\Events\DialySignalAkasanpeCheck;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {   //処理時間：30分くらい
            event(new DialyStocksCheck());
        })->weekdays()->at('15:30');

        $schedule->call(function () {   //処理時間：?
            event(new DialySignalAkasanpeCheck());
        })->weekdays()->at('16:00');

        $schedule->call(function () {
            event(new DialyMeigarasCheck());
        })->dailyAt('17:10');

        $schedule->call(function () {   //処理時間：?
            event(new DialyExtraStocksCheck());
        })->dailyAt('23:00');

        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
