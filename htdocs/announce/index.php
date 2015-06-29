<?php

require dirname(__FILE__).'/../../conf/gsl.php';
require dirname(__FILE__).'/../../conf/db.php';

// ip and port where servers should return pings
$gsl_ip = '127.0.0.1';
$gsl_port = '42001';

$result = array();

function exitWithMessage($message) {
    global $result;

    $result['message'] = $message;
    $result['time'] = microtime(TRUE);

    header('Content-Type: application/json');
    echo json_encode($result, JSON_PRETTY_PRINT);
    exit();
}

if (!isset(
    $_REQUEST['game_name'],
    $_REQUEST['game_version'],
    $_REQUEST['name'],
    $_REQUEST['password'],
    $_REQUEST['port']
))
{
    exitWithMessage('Missing parameter');
}

$hostname = isset($_REQUEST['host']) ? $_REQUEST['host'] : $_SERVER['REMOTE_ADDR'];

if (isset($_REQUEST['latitude'], $_REQUEST['longitude']))
{
    $latitude = $_REQUEST['latitude'];
    $longitude = $_REQUEST['longitude'];
}
else {
    $latitude = $longitude = NULL;
}


/*
 * Find game, must be exact version
 */

$query_find_game = $db->prepare("
SELECT
    id
FROM
    game
WHERE
    name = ?
AND
    version = ?
");

$query_find_game->execute(
    array(
        $_REQUEST['game_name'],
        $_REQUEST['game_version']
    )
);

$game = $query_find_game->fetch() or exitWithMessage('Game not found');



/*
 * Find server and update, or insert new server
 */

$query_find_server = $db->prepare("
SELECT
    id,
    password
FROM
    server
WHERE
    game_id = ?
AND
    name = ?
");

$query_find_server->execute(
    array(
        $game->id,
        $_REQUEST['name']
    )
);

$session_id = openssl_random_pseudo_bytes(20);

if ($server = $query_find_server->fetch())
{
    if (!password_verify($_REQUEST['password'], $server->password))
    {
        exitWithMessage('Invalid password');
    }

    $query_update_server = $db->prepare("
UPDATE
    server
SET
    session = ?,
    host = ?,
    port = ?,
    latitude = ?,
    longitude = ?,
    updated = NOW()
WHERE
    id = ?
");
    $query_update_server->execute(
        array(
            $session_id,
            $hostname,
            $_REQUEST['port'],
            $latitude,
            $longitude,
            $server->id
        )
    );

    $server_id = (int)$server->id;

}
else
{
    $query_insert_server = $db->prepare("
INSERT INTO
    server
(
    game_id,
    name,
    host,
    port,
    latitude,
    longitude,
    password,
    session
)
VALUES
(
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?
)
");
    $query_insert_server->execute(
        array(
            $game->id,
            $_REQUEST['name'],
            $hostname,
            $_REQUEST['port'],
            $latitude,
            $longitude,
            password_hash($_REQUEST['password'], PASSWORD_DEFAULT),
            $session_id
        )
    );

    $server_id = (int)$db->lastInsertId();

}

$result['pong_ip'] = $gsl_config['pong_ip'];
$result['pong_port'] = $gsl_config['pong_port'];
$result['session'] = current(unpack('H*',$session_id));

exitWithMessage('OK');
