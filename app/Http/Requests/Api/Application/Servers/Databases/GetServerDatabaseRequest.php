<?php

namespace MantaCil\Http\Requests\Api\Application\Servers\Databases;

use MantaCil\Services\Acl\Api\AdminAcl;
use MantaCil\Http\Requests\Api\Application\ApplicationApiRequest;

class GetServerDatabaseRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_SERVER_DATABASES;

    protected int $permission = AdminAcl::READ;
}
