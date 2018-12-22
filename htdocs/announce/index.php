<?php

require dirname(__FILE__).'/../../conf/gsl.php';
require dirname(__FILE__).'/../../conf/db.php';

// ip and port where servers should return pings
$gsl_ip = '127.0.0.1';
$gsl_port = '42001';

$result = array(
    'message' => ''
);

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
    $_REQUEST['game_mode'],
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

$max_players = isset($_REQUEST['max_players']) ? (int)$_REQUEST['max_players'] : 0;


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
 * Find game mode
 */

$query_find_game_mode = $db->prepare("
SELECT
    id
FROM
    game_mode
WHERE
    game_id = ?
AND
    name = ?
");

$query_find_game_mode->execute(
    array(
        $game->id,
        $_REQUEST['game_mode']
    )
);

$game_mode = $query_find_game_mode->fetch() or exitWithMessage('Game mode not found');



/*
 * Find country
 */

$country_id = NULL;

if (isset($_REQUEST['country']))
{

   $country_search_field = NULL;

    switch (strlen($_REQUEST['country']))
    {
        case 2:
            $query_find_country = $db->prepare("
SELECT
    id
FROM
    country
WHERE
    code2 = ?
");
            break;

        case 3:
            $query_find_country = $db->prepare("
SELECT
    id
FROM
    country
WHERE
    code3 = ?
");
            break;

        default:
            $query_find_country = $db->prepare("
SELECT
    id
FROM
    country
WHERE
    common_name = ?
");
            break;
    }

    $query_find_country->execute(
        array(
            $_REQUEST['country']
        )
    );

    $country = $query_find_country->fetch() or exitWithMessage('Country not found');
    $country_id = (int)$country->id;
}

/*
 * Find server and update, or insert new server
 */

$query_find_server = $db->prepare("
SELECT
    id,
    status,
    password
FROM
    server
WHERE
    game_mode_id = ?
AND
    name = ?
");

$query_find_server->execute(
    array(
        $game_mode->id,
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

    if ('disabled'===$server->status)
    {
        exitWithMessage('Account disabled');
    }

    if ('old version'===$server->status)
    {
        // this shouldn't happen, the game wouldn't be found above unless the version matches
        exitWithMessage('Update required');
    }

    // $reconnect_status = 'reconnecting';

    // skip pinging the server and just assume it's online for now
    $reconnect_status = 'online';

    $query_update_server = $db->prepare("
UPDATE
    server
SET
    session = ?,
    host = ?,
    port = ?,
    country_id = ?,
    latitude = ?,
    longitude = ?,
    max_players = ?,
    status = ?,
    updated = NOW()
WHERE
    id = ?
");
    $query_update_server->execute(
        array(
            $session_id,
            $hostname,
            $_REQUEST['port'],
            $country_id,
            $latitude,
            $longitude,
            $max_players,
            $reconnect_status,
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
    game_mode_id,
    name,
    host,
    port,
    country_id,
    latitude,
    longitude,
    max_players,
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
    ?,
    ?,
    ?,
    ?
)
");
    $query_insert_server->execute(
        array(
            $game->id,
            $game_mode->id,
            $_REQUEST['name'],
            $hostname,
            $_REQUEST['port'],
            $country_id,
            $latitude,
            $longitude,
            $max_players,
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
