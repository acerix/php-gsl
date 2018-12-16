#!/usr/bin/env php
<?php

require dirname(__FILE__).'/../conf/gsl.php';
require dirname(__FILE__).'/../conf/db.php';

$query_games = $db->prepare("
SELECT
    id,
    name,
    version,
    version_url,
    version_url_type
FROM
    game
ORDER BY
    name,
    version
");

$query_games->execute();

$games = array();

while ($game = $query_games->fetch())
{
    /*
     *  Check for updated version
     */
    $new_version = NULL;
    if (NULL!==$game->version_url_type) switch ($game->version_url_type)
    {

        case 'url':
            $new_version = file_get_contents($game->version_url);
            break;

        case 'github':
	    break;
            $latest_release = json_decode(file_get_contents(
                'https://api.github.com/repos/'.$game->version_url.'/releases/latest',
                FALSE,
                stream_context_create(array('http' => array('user_agent'=>'PHP/'.phpversion())))
            ));
            if (!isset($latest_release->tag_name)) {
                print('Failed to find github releases/latest tag_name'.PHP_EOL);
            }
            else {
                $new_version = $latest_release->tag_name;
            }
            break;
    }

    /*
     *  Update version in database
     */
    if (NULL!==$new_version&&$game->version!==$new_version)
    {
        $query_update_game_version = $db->prepare("
UPDATE
    game
SET
    version = ?,
    UPDATED = NOW()
WHERE
    id = ?
");
        $query_update_game_version->execute(
            array(
                $new_version,
                $game->id
            )
        );
        $game->version = $new_version;

        // Disconnect all servers of this game
        $query_expire_game_servers = $db->prepare("
UPDATE
    server
JOIN
    game_mode
        ON
            game_mode.id = server.game_mode_id
SET
    server.status = 'old version',
    server.session = NULL,
    server.updated = NOW()
WHERE
    game_mode.game_id = ?
");
        $query_expire_game_servers->execute(
            array(
                $game->id
            )
        );

    }

    /*
     *  Add to game list
     */
    $games[] = array(
        (int)$game->id,
        $game->name,
        $game->version
    );
}

if (!empty($gsl_config['generate_msgpack']))
file_put_contents(
    '../htdocs/games/games.msgpack',
    msgpack_pack($games)
);

if (!empty($gsl_config['generate_json']))
file_put_contents(
    '../htdocs/games/games.json',
    json_encode($games, JSON_PRETTY_PRINT)
);

