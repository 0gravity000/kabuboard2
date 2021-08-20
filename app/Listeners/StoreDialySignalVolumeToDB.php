<?php

namespace App\Listeners;

use App\Events\DialySignalVolumeCheck;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        //
    }
}
