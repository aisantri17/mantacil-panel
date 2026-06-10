<?php

namespace MantaCil\Http\Requests\Api\Application\Users;

use MantaCil\Services\Acl\Api\AdminAcl;
use MantaCil\Http\Requests\Api\Application\ApplicationApiRequest;

class DeleteUserRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_USERS;

    protected int $permission = AdminAcl::WRITE;
}
