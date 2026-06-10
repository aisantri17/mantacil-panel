<?php

namespace MantaCil\Contracts\Repository;

use MantaCil\Models\Nest;
use Illuminate\Database\Eloquent\Collection;

interface NestRepositoryInterface extends RepositoryInterface
{
    /**
     * Return a nest or all nests with their associated eggs and variables.
     *
     * @throws \MantaCil\Exceptions\Repository\RecordNotFoundException
     */
    public function getWithEggs(?int $id = null): Collection|Nest;

    /**
     * Return a nest or all nests and the count of eggs and servers for that nest.
     *
     * @throws \MantaCil\Exceptions\Repository\RecordNotFoundException
     */
    public function getWithCounts(?int $id = null): Collection|Nest;

    /**
     * Return a nest along with its associated eggs and the servers relation on those eggs.
     *
     * @throws \MantaCil\Exceptions\Repository\RecordNotFoundException
     */
    public function getWithEggServers(int $id): Nest;
}
