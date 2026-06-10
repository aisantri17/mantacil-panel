<?php

namespace MantaCil\Http\Requests\Api\Client\Servers\Subusers;

use MantaCil\Models\Permission;

class DeleteSubuserRequest extends SubuserRequest
{
    public function permission(): string
    {
        return Permission::ACTION_USER_DELETE;
    }
}
