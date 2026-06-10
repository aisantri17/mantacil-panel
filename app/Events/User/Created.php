<?php

namespace MantaCil\Events\User;

use MantaCil\Models\User;
use MantaCil\Events\Event;
use Illuminate\Queue\SerializesModels;

class Created extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public User $user)
    {
    }
}
