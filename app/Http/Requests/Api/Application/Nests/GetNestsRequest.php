<?php

namespace MantaCil\Http\Requests\Api\Application\Nests;

use MantaCil\Services\Acl\Api\AdminAcl;
use MantaCil\Http\Requests\Api\Application\ApplicationApiRequest;

class GetNestsRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_NESTS;

    protected int $permission = AdminAcl::READ;
}
