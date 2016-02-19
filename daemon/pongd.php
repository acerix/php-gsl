#!/usr/bin/env php
<?php

/*
* Listens for ping responses and updates server status
*/

require dirname(__FILE__).'/../conf/db.php';

require dirname(__FILE__).'/../vendor/autoload.php';
require dirname(__FILE__).'/../proto/ping.php';
require dirname(__FILE__).'/../proto/pong.php';

$receive_len = 30;

$udp_socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

socket_bind($udp_socket, '0.0.0.0', 42001);

$query_server_log = $db->prepare("
SELECT
    server_log.server_id,
    server_log.nonce,
    server.session
FROM
    server_log
JOIN
    server
        ON
            server.id = server_log.server_id
WHERE
    server_log.id = ?
AND
    server_log.status = 'new'
");

$query_update_server_log = $db->prepare("
UPDATE
    server_log
SET
    status = 'online',
    nonce = NULL,
    latency = 1000 * (NOW(6) - created),
    players = ?
WHERE
    id = ?
");

$query_update_server = $db->prepare("
UPDATE
    server
SET
    status = 'online',
    latency = (SELECT latency FROM server_log WHERE server_log.id = ?),
    players = ?,
    updated = NOW()
WHERE
    id = ?
");

while (socket_recvfrom($udp_socket, $buf, $receive_len, 0, $ip, $port))
{
    print('received ' . $receive_len . ' bytes from ' . $ip . PHP_EOL);

    if ('pong'===substr($buf,0,4)) {

        print('looks like a pong' . PHP_EOL);
        
        $pong = \DrSlump\Protobuf\Protobuf::decode('Pong', substr($buf,4));
        
        $query_server_log->execute(
            array(
                $pong->server_log_id
            )
        );

        if ($server_log = $query_server_log->fetch())
        {
            print('found server_log_id' . PHP_EOL);
            if ($pong->key===hash('sha1', $server_log->session . $server_log->nonce, true))
            {
                print('sha1 validated' . PHP_EOL);

                $query_update_server_log->execute(
                    array(
                        $pong->player_count,
                        $pong->server_log_id
                    )
                );

                $query_update_server->execute(
                    array(
                        $pong->server_log_id,
                        $pong->player_count,
                        $server_log->server_id
                    )
                );

                print('database updated' . PHP_EOL);

            }
            else {
                print('invalid sha1!' . PHP_EOL);
            }
        }
        else {
            print('invalid server_log_id!' . PHP_EOL);
        }

    }
    print(PHP_EOL . 'waiting for next packet' . PHP_EOL . PHP_EOL);
}

