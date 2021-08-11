<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\DialyMeigarasCheck' => [
            'App\Listeners\ScrapingMeigarasToDB',
        ],
        'App\Events\DialyStocksCheck' => [
            'App\Listeners\ScrapingDailySocksToDB',
        ],
        /*
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        */
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
