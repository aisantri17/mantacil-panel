<?php

namespace MantaCil\Services\Locations;

use MantaCil\Models\Location;
use MantaCil\Contracts\Repository\LocationRepositoryInterface;

class LocationCreationService
{
    /**
     * LocationCreationService constructor.
     */
    public function __construct(protected LocationRepositoryInterface $repository)
    {
    }

    /**
     * Create a new location.
     *
     * @throws \MantaCil\Exceptions\Model\DataValidationException
     */
    public function handle(array $data): Location
    {
        return $this->repository->create($data);
    }
}
