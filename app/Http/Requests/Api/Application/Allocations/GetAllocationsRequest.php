<?php

namespace MantaCil\Http\Requests\Api\Application\Allocations;

use MantaCil\Services\Acl\Api\AdminAcl;
use MantaCil\Http\Requests\Api\Application\ApplicationApiRequest;

class GetAllocationsRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_ALLOCATIONS;

    protected int $permission = AdminAcl::READ;
}
