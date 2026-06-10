<?php

namespace MantaCil\Facades;

use Illuminate\Support\Facades\Facade;
use MantaCil\Services\Activity\ActivityLogTargetableService;

/**
 * @mixin \MantaCil\Services\Activity\ActivityLogTargetableService
 */
class LogTarget extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActivityLogTargetableService::class;
    }
}
