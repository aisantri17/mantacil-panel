<?php

namespace MantaCil\Http\Requests\Api\Application\Nests\Eggs;

use MantaCil\Services\Acl\Api\AdminAcl;
use MantaCil\Http\Requests\Api\Application\ApplicationApiRequest;

class GetEggRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_EGGS;

    protected int $permission = AdminAcl::READ;
}
