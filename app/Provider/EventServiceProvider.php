<?php

namespace App\Provider;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Event\SomeEvent' => [
            'App\Listener\EventListener',
        ],
    ];
}
