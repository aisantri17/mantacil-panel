<?php

namespace MantaCil\Repositories\Eloquent;

use MantaCil\Models\ServerVariable;
use MantaCil\Contracts\Repository\ServerVariableRepositoryInterface;

class ServerVariableRepository extends EloquentRepository implements ServerVariableRepositoryInterface
{
    /**
     * Return the model backing this repository.
     */
    public function model(): string
    {
        return ServerVariable::class;
    }
}
