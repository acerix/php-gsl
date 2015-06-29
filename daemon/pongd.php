#!/usr/bin/env php
<?php

include dirname(__FILE__).'/../conf/db.php';

/*
* Listen for ping responses and update server status
*/

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
    if ('pong'===substr($buf,0,4)&&$receive_len===strlen($buf)) {

        $server_log_id = current(unpack('V',substr($buf,4,4)));
        $key = substr($buf,8,20);
        $player_count = current(unpack('v',substr($buf,28,2)));

        $query_server_log->execute(
            array(
                $server_log_id
            )
        );

        if ($server_log = $query_server_log->fetch())
        {
            if ($key===hash('sha1', $server_log->session . $server_log->nonce, true))
            {
                $query_update_server_log->execute(
                    array(
                        $player_count,
                        $server_log_id
                    )
                );

                $query_update_server->execute(
                    array(
                        $server_log_id,
                        $player_count,
                        $server_log->server_id
                    )
                );

            }
        }

    }
}

