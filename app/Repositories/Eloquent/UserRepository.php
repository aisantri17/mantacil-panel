<?php

namespace MantaCil\Repositories\Eloquent;

use MantaCil\Models\User;
use MantaCil\Contracts\Repository\UserRepositoryInterface;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * Return the model backing this repository.
     */
    public function model(): string
    {
        return User::class;
    }
}
