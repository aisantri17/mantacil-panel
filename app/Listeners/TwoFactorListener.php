<?php

namespace MantaCil\Listeners;

use MantaCil\Facades\Activity;
use Illuminate\Contracts\Events\Dispatcher;
use MantaCil\Events\Auth\ProvidedAuthenticationToken;
use MantaCil\Extensions\Illuminate\Events\Contracts\SubscribesToEvents;

class TwoFactorListener implements SubscribesToEvents
{
    public function __invoke(ProvidedAuthenticationToken $event): void
    {
        Activity::event($event->recovery ? 'auth:recovery-token' : 'auth:token')
            ->withRequestMetadata()
            ->subject($event->user)
            ->log();
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(ProvidedAuthenticationToken::class, self::class);
    }
}
