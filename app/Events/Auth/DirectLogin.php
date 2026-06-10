<?php

namespace MantaCil\Events\Auth;

use MantaCil\Models\User;
use MantaCil\Events\Event;

class DirectLogin extends Event
{
    public function __construct(public User $user, public bool $remember)
    {
    }
}
