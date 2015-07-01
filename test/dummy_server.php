#!/usr/bin/env php
<?php

/*
* Dummy server, all it does is respond to pings
*/


require dirname(__FILE__).'/../conf/gsl.php';

/*
* Connect to GSL
*/

$announce_request_data = array(
    'game_name' => 'Game',
    'game_version' => '0.1',
    'game_mode' => 'Hard',
    'name' => 'MyServer',
    'password' => 'My$ecurePassword',
    'host' => 'localhost',
    'port' => 42002,
    'country' => 'CA',
    'latitude' => 45.42,
    'longitude' => -75.69,
    'max_players' => 32
);

$json_response_data = file_get_contents($gsl_config['announce_url'].'?'.http_build_query($announce_request_data));
$response_data = json_decode($json_response_data);

if (!isset($response_data->message))
{
    die('Invalid GSL response');
}

if ('OK'!==$response_data->message)
{
    die('GSL Error: '.$response_data->message);
}

$session_id = $response_data->session;
$pong_ip = $response_data->pong_ip;
$pong_port = $response_data->pong_port;


/*
* Listen for UDP and respond to pings
*/

$receive_len = 48;

$udp_socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

socket_bind($udp_socket, '0.0.0.0', 42002);

// recv data
$buf = '';
$name = '';
$port = 0;

while (socket_recvfrom($udp_socket, $buf, $receive_len, 0, $ip, $port))
{
    if ('ping'===substr($buf,0,4)&&$receive_len===strlen($buf)) {
        $ping_session_id = substr($buf,4,20);

        print(
        'test'
        . ' ping_session_id:' . current(unpack('H*',$ping_session_id))
        . ' session_id:' . current(unpack('H*',$session_id))
        . PHP_EOL
        );

        if ($ping_session_id!==$session_id) {
            //die('Invalid session ID received');
            continue;
        }
        $server_log_id_binary = substr($buf,24,4);
        //$server_log_id = current(unpack('V',$server_log_id_binary));
        $nonce = substr($buf,28);

        // @todo sample data
        $player_count = rand(0,65535);

        $send_buffer = 'pong' . $server_log_id_binary . hash('sha1', $session_id . $nonce, true) . pack('v', $player_count);

        print('ping session_id:' . $session_id . ' nonce:' . $nonce . PHP_EOL);

        socket_sendto(
            $udp_socket,
            $send_buffer,
            strlen($send_buffer),
            0,
            $pong_ip,
            $pong_port
        );

    }
}
