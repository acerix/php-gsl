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

$query_games->execute();

$games = array();

while ($game = $query_games->fetch())
{
    $games[] = array(
        (int)$game->id,
        $game->name,
        $game->version
    );
}

if (!empty($gsl_config['generate_bson']))
file_put_contents(
    '../htdocs/games/games.bson',
    bson_encode($games)
);

if (!empty($gsl_config['generate_json']))
file_put_contents(
    '../htdocs/games/games.json',
    json_encode($games, JSON_PRETTY_PRINT)
);

