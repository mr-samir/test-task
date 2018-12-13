<?php

namespace ChatApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Predis\Async\Client;

class Chat implements MessageComponentInterface
{
    const CHANNEL = 'chat';

    /** @var \SplObjectStorage */
    private $wsClients;

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        $this->wsClients = new \SplObjectStorage();

        echo "Ratchet Chat server running\n";
    }

    /**
     * @param $redis
     */
    public function init(Client $redis)
    {
        echo "Connected to Redis, now listening for incoming messages...\n";

        $redis->pubSubLoop(static::CHANNEL, function ($event) {
            echo "Received message `{$event->payload}` from {$event->channel}.\n";

            $json = json_decode($event->payload, true);
            $slotPath = isset($json['slot_element_id'])
                ? '/slot/' . $json['slot_element_id']
                : null
            ;

            /** @var \Ratchet\WebSocket\Version\RFC6455\Connection $wsClient */
            foreach ($this->wsClients as $wsClient) {
                $webSocket = (array) $wsClient->WebSocket;
                $request = isset($webSocket['request']) ? $webSocket['request'] : null;

                if ($request instanceof \Guzzle\Http\Message\Request) {
                    if ($request->getPath() === '/' || $request->getPath() === $slotPath) {
                        $wsClient->send($event->payload);
                    }
                }
            }
        });
    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn)
    {
        /** @var \Ratchet\WebSocket\Version\RFC6455\Connection $conn */

        // Store the new connection to send messages to later
        $this->wsClients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    /**
     * @param ConnectionInterface $from
     * @param string $msg
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {
        // we don't want to do anything with incoming messages
    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn)
    {
        /** @var \Ratchet\WebSocket\Version\RFC6455\Connection $conn */

        // The connection is closed, remove it, as we can no longer send it messages
        $this->wsClients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        trigger_error("An error has occurred: {$e->getMessage()}\n", E_USER_WARNING);
        $conn->close();
    }
}
