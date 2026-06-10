<?php

namespace MantaCil\Facades;

use Illuminate\Support\Facades\Facade;
use MantaCil\Services\Activity\ActivityLogService;

class Activity extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActivityLogService::class;
    }
}
