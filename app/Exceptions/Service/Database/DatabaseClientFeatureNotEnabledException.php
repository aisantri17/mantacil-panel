<?php

namespace MantaCil\Exceptions\Service\Database;

use MantaCil\Exceptions\MantaCilException;

class DatabaseClientFeatureNotEnabledException extends MantaCilException
{
    public function __construct()
    {
        parent::__construct('Client database creation is not enabled in this Panel.');
    }
}
