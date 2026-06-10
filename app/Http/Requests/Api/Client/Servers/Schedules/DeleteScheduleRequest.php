<?php

namespace MantaCil\Http\Requests\Api\Client\Servers\Schedules;

use MantaCil\Models\Permission;

class DeleteScheduleRequest extends ViewScheduleRequest
{
    public function permission(): string
    {
        return Permission::ACTION_SCHEDULE_DELETE;
    }
}
