<?php

namespace MantaCil\Events\Server;

use MantaCil\Events\Event;
use MantaCil\Models\Server;
use Illuminate\Queue\SerializesModels;

class Created extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Server $server)
    {
    }
}
