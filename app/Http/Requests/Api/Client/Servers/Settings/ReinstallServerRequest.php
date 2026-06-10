<?php

namespace MantaCil\Http\Requests\Api\Client\Servers\Settings;

use MantaCil\Models\Permission;
use MantaCil\Http\Requests\Api\Client\ClientApiRequest;

class ReinstallServerRequest extends ClientApiRequest
{
    public function permission(): string
    {
        return Permission::ACTION_SETTINGS_REINSTALL;
    }
}
