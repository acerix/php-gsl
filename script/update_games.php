#!/usr/bin/env php
<?php

include dirname(__FILE__).'/../conf/db.php';

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

file_put_contents(
    '../htdocs/games.bson',
    bson_encode($games)
);

