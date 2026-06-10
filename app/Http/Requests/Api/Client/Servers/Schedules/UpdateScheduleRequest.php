<?php

namespace MantaCil\Http\Requests\Api\Client\Servers\Schedules;

use MantaCil\Models\Permission;

class UpdateScheduleRequest extends StoreScheduleRequest
{
    public function permission(): string
    {
        return Permission::ACTION_SCHEDULE_UPDATE;
    }
}
