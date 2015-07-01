#!/usr/bin/env php
<?php

require dirname(__FILE__).'/../conf/gsl.php';
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

$query_game_modes = $db->prepare("
SELECT
    id,
    name
FROM
    game_mode
WHERE
    game_id = ?
");

$query_servers = $db->prepare("
SELECT
    server.*,
    country.code3 country_code
FROM
    server
LEFT JOIN
    country
        ON
            country.id = server.country_id
WHERE
    game_mode_id = ?
AND
    status NOT IN ('disconnected','disabled')
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
AND
    status NOT IN ('disconnected','disabled')
");

$udp_socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

$query_games->execute();

while ($game = $query_games->fetch())
{

    $game->dir = '../htdocs/games/'.$game->name;

    if (!is_dir($game->dir))
    {
        mkdir($game->dir);
    }

    $query_game_modes->execute(
        array(
            $game->id
        )
    );

    $game_modes = array();

    while ($game_mode = $query_game_modes->fetch())
    {

        $game_mode->dir = $game->dir.'/'.$game_mode->name;

        if (!is_dir($game_mode->dir))
        {
            mkdir($game_mode->dir);
        }

        $query_servers->execute(
            array(
                $game_mode->id
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

/*
            print(
            'ping'
            . ' session:' . current(unpack('H*',$r->session))
            . ' id:' . $server_log_id
            . ' nonce:' . current(unpack('H*',$nonce))
            . ' ip:' .  $ip
            . ' port:' . $r->port
            . PHP_EOL
            );
*/

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
                    (int)$r->players,
                    (int)$r->max_players,
                    (int)$r->setting,
                    $r->country_code,
                    (float)$r->latitude,
                    (float)$r->longitude
                );
            }

        }

        if (!empty($gsl_config['generate_bson']))
        file_put_contents(
            $game_mode->dir.'/servers.bson',
            bson_encode($servers)
        );

        if (!empty($gsl_config['generate_json']))
        file_put_contents(
           $game_mode->dir.'/servers.json',
            json_encode($servers, JSON_PRETTY_PRINT)
        );

    }
}
