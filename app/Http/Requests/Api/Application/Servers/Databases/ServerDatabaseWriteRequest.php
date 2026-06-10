<?php

namespace MantaCil\Http\Requests\Api\Application\Servers\Databases;

use MantaCil\Services\Acl\Api\AdminAcl;

class ServerDatabaseWriteRequest extends GetServerDatabasesRequest
{
    protected int $permission = AdminAcl::WRITE;
}
