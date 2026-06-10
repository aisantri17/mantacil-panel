<?php

namespace MantaCil\Contracts\Core;

use MantaCil\Events\Event;

interface ReceivesEvents
{
    /**
     * Handles receiving an event from the application.
     */
    public function handle(Event $notification): void;
}
