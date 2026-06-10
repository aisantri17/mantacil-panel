<?php

namespace MantaCil\Exceptions\Service;

use Illuminate\Http\Response;
use MantaCil\Exceptions\DisplayException;

class HasActiveServersException extends DisplayException
{
    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }
}
