<?php

namespace MantaCil\Repositories\Wings;

use Webmozart\Assert\Assert;
use MantaCil\Models\Server;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\TransferException;
use MantaCil\Exceptions\Http\Connection\DaemonConnectionException;

/**
 * @method \MantaCil\Repositories\Wings\DaemonCommandRepository setNode(\MantaCil\Models\Node $node)
 * @method \MantaCil\Repositories\Wings\DaemonCommandRepository setServer(\MantaCil\Models\Server $server)
 */
class DaemonCommandRepository extends DaemonRepository
{
    /**
     * Sends a command or multiple commands to a running server instance.
     *
     * @throws DaemonConnectionException
     */
    public function send(array|string $command): ResponseInterface
    {
        Assert::isInstanceOf($this->server, Server::class);

        try {
            return $this->getHttpClient()->post(
                sprintf('/api/servers/%s/commands', $this->server->uuid),
                [
                    'json' => ['commands' => is_array($command) ? $command : [$command]],
                ]
            );
        } catch (TransferException $exception) {
            throw new DaemonConnectionException($exception);
        }
    }
}
