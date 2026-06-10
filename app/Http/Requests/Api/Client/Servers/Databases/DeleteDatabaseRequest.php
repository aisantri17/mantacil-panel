<?php

namespace MantaCil\Http\Requests\Api\Client\Servers\Databases;

use MantaCil\Models\Permission;
use MantaCil\Contracts\Http\ClientPermissionsRequest;
use MantaCil\Http\Requests\Api\Client\ClientApiRequest;

class DeleteDatabaseRequest extends ClientApiRequest implements ClientPermissionsRequest
{
    public function permission(): string
    {
        return Permission::ACTION_DATABASE_DELETE;
    }
}
