<?php

namespace MantaCil\Http\Controllers\Api\Application\Servers;

use MantaCil\Models\Server;
use MantaCil\Services\Servers\BuildModificationService;
use MantaCil\Services\Servers\DetailsModificationService;
use MantaCil\Transformers\Api\Application\ServerTransformer;
use MantaCil\Http\Controllers\Api\Application\ApplicationApiController;
use MantaCil\Http\Requests\Api\Application\Servers\UpdateServerDetailsRequest;
use MantaCil\Http\Requests\Api\Application\Servers\UpdateServerBuildConfigurationRequest;

class ServerDetailsController extends ApplicationApiController
{
    /**
     * ServerDetailsController constructor.
     */
    public function __construct(
        private BuildModificationService $buildModificationService,
        private DetailsModificationService $detailsModificationService,
    ) {
        parent::__construct();
    }

    /**
     * Update the details for a specific server.
     *
     * @throws \MantaCil\Exceptions\DisplayException
     * @throws \MantaCil\Exceptions\Model\DataValidationException
     * @throws \MantaCil\Exceptions\Repository\RecordNotFoundException
     */
    public function details(UpdateServerDetailsRequest $request, Server $server): array
    {
        $updated = $this->detailsModificationService->returnUpdatedModel()->handle(
            $server,
            $request->validated()
        );

        return $this->fractal->item($updated)
            ->transformWith($this->getTransformer(ServerTransformer::class))
            ->toArray();
    }

    /**
     * Update the build details for a specific server.
     *
     * @throws \MantaCil\Exceptions\DisplayException
     * @throws \MantaCil\Exceptions\Model\DataValidationException
     * @throws \MantaCil\Exceptions\Repository\RecordNotFoundException
     */
    public function build(UpdateServerBuildConfigurationRequest $request, Server $server): array
    {
        $server = $this->buildModificationService->handle($server, $request->validated());

        return $this->fractal->item($server)
            ->transformWith($this->getTransformer(ServerTransformer::class))
            ->toArray();
    }
}
