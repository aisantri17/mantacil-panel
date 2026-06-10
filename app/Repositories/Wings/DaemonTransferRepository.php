<?php

namespace MantaCil\Repositories\Wings;

use MantaCil\Models\Node;
use Lcobucci\JWT\Token\Plain;
use GuzzleHttp\Exception\GuzzleException;
use MantaCil\Exceptions\Http\Connection\DaemonConnectionException;

/**
 * @method \MantaCil\Repositories\Wings\DaemonTransferRepository setNode(\MantaCil\Models\Node $node)
 * @method \MantaCil\Repositories\Wings\DaemonTransferRepository setServer(\MantaCil\Models\Server $server)
 */
class DaemonTransferRepository extends DaemonRepository
{
    /**
     * @throws DaemonConnectionException
     */
    public function notify(Node $targetNode, Plain $token): void
    {
        try {
            $this->getHttpClient()->post(sprintf('/api/servers/%s/transfer', $this->server->uuid), [
                'json' => [
                    'server_id' => $this->server->uuid,
                    'url' => $targetNode->getConnectionAddress() . '/api/transfers',
                    'token' => 'Bearer ' . $token->toString(),
                    'server' => [
                        'uuid' => $this->server->uuid,
                        'start_on_completion' => false,
                    ],
                ],
            ]);
        } catch (GuzzleException $exception) {
            throw new DaemonConnectionException($exception);
        }
    }
}
