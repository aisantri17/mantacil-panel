<?php

namespace MantaCil\Exceptions\Service\Allocation;

use MantaCil\Exceptions\DisplayException;

class PortOutOfRangeException extends DisplayException
{
    /**
     * PortOutOfRangeException constructor.
     */
    public function __construct()
    {
        parent::__construct(trans('exceptions.allocations.port_out_of_range'));
    }
}
