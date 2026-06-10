<?php

namespace MantaCil\Facades;

use Illuminate\Support\Facades\Facade;
use MantaCil\Services\Activity\ActivityLogBatchService;

class LogBatch extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActivityLogBatchService::class;
    }
}
