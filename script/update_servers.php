#!/usr/bin/env php
<?php

require dirname(__FILE__).'/../conf/db.php';

$query_games = $db->prepare("
SELECT
    id,
    name,
    version
FROM
    game
ORDER BY
    name,
    version
");

$query_servers = $db->prepare("
SELECT
    server.id,
    server.name,
    server.session,
    server.host,
    server.port,
    server.status,
    server.latency,
    server.players
FROM
    server
LEFT JOIN
    country
        ON
            country.id = server.country_id
WHERE
    game_id = ?
AND
    status <> 'disconnected'
");

$query_insert_server_log = $db->prepare("
INSERT INTO
    server_log
(
    server_id,
    nonce
)
VALUES
(
    ?,
    ?
)
");

$query_update_server_status = $db->prepare("
UPDATE
    server
SET
    status = ?
WHERE
    id = ?
");

$udp_socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

$query_games->execute();

while ($game = $query_games->fetch())
{
    $query_servers->execute(
        array(
            $game->id
        )
    );

    $servers = array();

    while ($r = $query_servers->fetch())
    {

        /*
        * Ping server
        */

        // Resolve IP

        if (filter_var($r->host, FILTER_VALIDATE_IP))
        {
            $ip = $r->host;
        }
        else
        {
            $ip = gethostbyname($r->host);

            // resolve has failed if result matches input
            if ($ip===$r->host)
            {
                $query_update_server_status->execute(
                    array(
                        'dns fail',
                        $r->id
                    )
                );
                continue;
            }
        }

        // Generate nonce and save to db

        $nonce = openssl_random_pseudo_bytes(20);

        $query_insert_server_log->execute(
            array(
                $r->id,
                $nonce
            )
        );

        $server_log_id = (int)$db->lastInsertId();


        // Send packet

        $send_buffer = 'ping' . $r->session . pack('V',$server_log_id) . $nonce;

        socket_sendto(
            $udp_socket,
            $send_buffer,
            strlen($send_buffer),
            0,
            $ip,
            $r->port
        );

        /*
        * Update server list with previous ping result
        */

        if ('online'===$r->status)
        {
            $servers[] = array(
                (int)$r->id,
                $r->name,
                $r->host,
                (int)$r->port,
                (int)$r->latency,
                (int)$r->players
            );
        }

    }

    file_put_contents(
        '../htdocs/game'.$game->id.'_servers.bson',
        bson_encode($servers)
    );

}
