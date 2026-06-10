<?php

namespace MantaCil\Http\Requests\Api\Client\Servers\Network;

use MantaCil\Models\Permission;
use MantaCil\Http\Requests\Api\Client\ClientApiRequest;

class NewAllocationRequest extends ClientApiRequest
{
    public function permission(): string
    {
        return Permission::ACTION_ALLOCATION_CREATE;
    }
}
