<?php

namespace App\Listeners;

use App\Events\DialySignalKurosanpeCheck;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreDialySignalKurosanpeToDB
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
     * @param  DialySignalKurosanpeCheck  $event
     * @return void
     */
    public function handle(DialySignalKurosanpeCheck $event)
    {
        //
    }
}
