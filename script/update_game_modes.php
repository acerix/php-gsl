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

$query_games->execute();

$game_modes = array();

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
        $game_modes[] = array(
            (int)$game_mode->id,
            $game_mode->name
        );
    }

    if (!empty($gsl_config['generate_bson']))
    file_put_contents(
        $game->dir.'/modes.bson',
        bson_encode($game_modes)
    );

    if (!empty($gsl_config['generate_json']))
    file_put_contents(
       $game->dir.'/modes.json',
        json_encode($game_modes, JSON_PRETTY_PRINT)
    );

}
