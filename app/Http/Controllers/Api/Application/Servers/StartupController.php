<?php

namespace MantaCil\Http\Controllers\Api\Application\Servers;

use MantaCil\Models\User;
use MantaCil\Models\Server;
use MantaCil\Services\Servers\StartupModificationService;
use MantaCil\Transformers\Api\Application\ServerTransformer;
use MantaCil\Http\Controllers\Api\Application\ApplicationApiController;
use MantaCil\Http\Requests\Api\Application\Servers\UpdateServerStartupRequest;

class StartupController extends ApplicationApiController
{
    /**
     * StartupController constructor.
     */
    public function __construct(private StartupModificationService $modificationService)
    {
        parent::__construct();
    }

    /**
     * Update the startup and environment settings for a specific server.
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws \MantaCil\Exceptions\Http\Connection\DaemonConnectionException
     * @throws \MantaCil\Exceptions\Model\DataValidationException
     * @throws \MantaCil\Exceptions\Repository\RecordNotFoundException
     */
    public function index(UpdateServerStartupRequest $request, Server $server): array
    {
        $server = $this->modificationService
            ->setUserLevel(User::USER_LEVEL_ADMIN)
            ->handle($server, $request->validated());

        return $this->fractal->item($server)
            ->transformWith($this->getTransformer(ServerTransformer::class))
            ->toArray();
    }
}
