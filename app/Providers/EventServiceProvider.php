<?php

namespace MantaCil\Providers;

use MantaCil\Models\User;
use MantaCil\Models\Server;
use MantaCil\Models\Subuser;
use MantaCil\Models\EggVariable;
use MantaCil\Observers\UserObserver;
use MantaCil\Observers\ServerObserver;
use MantaCil\Observers\SubuserObserver;
use MantaCil\Listeners\TwoFactorListener;
use MantaCil\Listeners\RevocationListener;
use MantaCil\Observers\EggVariableObserver;
use MantaCil\Listeners\AuthenticationListener;
use MantaCil\Events\Server\Installed as ServerInstalledEvent;
use MantaCil\Notifications\ServerInstalled as ServerInstalledNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     */
    protected $listen = [
        ServerInstalledEvent::class => [ServerInstalledNotification::class],
    ];

    protected $subscribe = [
        AuthenticationListener::class,
        RevocationListener::class,
        TwoFactorListener::class,
    ];

    protected static $shouldDiscoverEvents = false;

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();

        User::observe(UserObserver::class);
        Server::observe(ServerObserver::class);
        Subuser::observe(SubuserObserver::class);
        EggVariable::observe(EggVariableObserver::class);
    }
}
