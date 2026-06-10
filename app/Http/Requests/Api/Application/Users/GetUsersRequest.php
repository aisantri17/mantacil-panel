<?php

namespace MantaCil\Http\Requests\Api\Application\Users;

use MantaCil\Services\Acl\Api\AdminAcl as Acl;
use MantaCil\Http\Requests\Api\Application\ApplicationApiRequest;

class GetUsersRequest extends ApplicationApiRequest
{
    protected ?string $resource = Acl::RESOURCE_USERS;

    protected int $permission = Acl::READ;
}
