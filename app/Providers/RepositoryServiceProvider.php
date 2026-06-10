<?php

namespace MantaCil\Providers;

use Illuminate\Support\ServiceProvider;
use MantaCil\Repositories\Eloquent\EggRepository;
use MantaCil\Repositories\Eloquent\NestRepository;
use MantaCil\Repositories\Eloquent\NodeRepository;
use MantaCil\Repositories\Eloquent\TaskRepository;
use MantaCil\Repositories\Eloquent\UserRepository;
use MantaCil\Repositories\Eloquent\ApiKeyRepository;
use MantaCil\Repositories\Eloquent\ServerRepository;
use MantaCil\Repositories\Eloquent\SessionRepository;
use MantaCil\Repositories\Eloquent\SubuserRepository;
use MantaCil\Repositories\Eloquent\DatabaseRepository;
use MantaCil\Repositories\Eloquent\LocationRepository;
use MantaCil\Repositories\Eloquent\ScheduleRepository;
use MantaCil\Repositories\Eloquent\SettingsRepository;
use MantaCil\Repositories\Eloquent\AllocationRepository;
use MantaCil\Contracts\Repository\EggRepositoryInterface;
use MantaCil\Repositories\Eloquent\EggVariableRepository;
use MantaCil\Contracts\Repository\NestRepositoryInterface;
use MantaCil\Contracts\Repository\NodeRepositoryInterface;
use MantaCil\Contracts\Repository\TaskRepositoryInterface;
use MantaCil\Contracts\Repository\UserRepositoryInterface;
use MantaCil\Repositories\Eloquent\DatabaseHostRepository;
use MantaCil\Contracts\Repository\ApiKeyRepositoryInterface;
use MantaCil\Contracts\Repository\ServerRepositoryInterface;
use MantaCil\Repositories\Eloquent\ServerVariableRepository;
use MantaCil\Contracts\Repository\SessionRepositoryInterface;
use MantaCil\Contracts\Repository\SubuserRepositoryInterface;
use MantaCil\Contracts\Repository\DatabaseRepositoryInterface;
use MantaCil\Contracts\Repository\LocationRepositoryInterface;
use MantaCil\Contracts\Repository\ScheduleRepositoryInterface;
use MantaCil\Contracts\Repository\SettingsRepositoryInterface;
use MantaCil\Contracts\Repository\AllocationRepositoryInterface;
use MantaCil\Contracts\Repository\EggVariableRepositoryInterface;
use MantaCil\Contracts\Repository\DatabaseHostRepositoryInterface;
use MantaCil\Contracts\Repository\ServerVariableRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register all the repository bindings.
     */
    public function register(): void
    {
        // Eloquent Repositories
        $this->app->bind(AllocationRepositoryInterface::class, AllocationRepository::class);
        $this->app->bind(ApiKeyRepositoryInterface::class, ApiKeyRepository::class);
        $this->app->bind(DatabaseRepositoryInterface::class, DatabaseRepository::class);
        $this->app->bind(DatabaseHostRepositoryInterface::class, DatabaseHostRepository::class);
        $this->app->bind(EggRepositoryInterface::class, EggRepository::class);
        $this->app->bind(EggVariableRepositoryInterface::class, EggVariableRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(NestRepositoryInterface::class, NestRepository::class);
        $this->app->bind(NodeRepositoryInterface::class, NodeRepository::class);
        $this->app->bind(ScheduleRepositoryInterface::class, ScheduleRepository::class);
        $this->app->bind(ServerRepositoryInterface::class, ServerRepository::class);
        $this->app->bind(ServerVariableRepositoryInterface::class, ServerVariableRepository::class);
        $this->app->bind(SessionRepositoryInterface::class, SessionRepository::class);
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);
        $this->app->bind(SubuserRepositoryInterface::class, SubuserRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
