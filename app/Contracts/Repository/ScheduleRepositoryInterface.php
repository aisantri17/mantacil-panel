<?php

namespace MantaCil\Contracts\Repository;

use MantaCil\Models\Schedule;
use Illuminate\Support\Collection;

interface ScheduleRepositoryInterface extends RepositoryInterface
{
    /**
     * Return all the schedules for a given server.
     */
    public function findServerSchedules(int $server): Collection;

    /**
     * Return a schedule model with all the associated tasks as a relationship.
     *
     * @throws \MantaCil\Exceptions\Repository\RecordNotFoundException
     */
    public function getScheduleWithTasks(int $schedule): Schedule;
}
