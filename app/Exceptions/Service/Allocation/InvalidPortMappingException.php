<?php

namespace MantaCil\Exceptions\Service\Allocation;

use MantaCil\Exceptions\DisplayException;

class InvalidPortMappingException extends DisplayException
{
    /**
     * InvalidPortMappingException constructor.
     */
    public function __construct(mixed $port)
    {
        parent::__construct(trans('exceptions.allocations.invalid_mapping', ['port' => $port]));
    }
}
