<?php

namespace MantaCil\Http\Requests\Api\Application\Nodes;

use MantaCil\Services\Acl\Api\AdminAcl;
use MantaCil\Http\Requests\Api\Application\ApplicationApiRequest;

class GetNodesRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_NODES;

    protected int $permission = AdminAcl::READ;
}
