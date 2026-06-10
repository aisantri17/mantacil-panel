<?php

namespace MantaCil\Http\Requests\Api\Application\Locations;

use MantaCil\Services\Acl\Api\AdminAcl;
use MantaCil\Http\Requests\Api\Application\ApplicationApiRequest;

class GetLocationsRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_LOCATIONS;

    protected int $permission = AdminAcl::READ;
}
