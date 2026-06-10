<?php

namespace MantaCil\Repositories\Eloquent;

use MantaCil\Models\RecoveryToken;

class RecoveryTokenRepository extends EloquentRepository
{
    public function model(): string
    {
        return RecoveryToken::class;
    }
}
