#!/usr/bin/env php
<?php

/*
* Dummy server, all it does is respond to pings
*/

$receive_len = 48;

$udp_socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

socket_bind($udp_socket, '0.0.0.0', 42002);

// pass by refs
$buf = '';
$name = '';
$port = 0;

while (socket_recvfrom($udp_socket, $buf, $receive_len, 0, $ip, $port))
{
    if ('ping'===substr($buf,0,4)&&$receive_len===strlen($buf)) {
        $session_id = substr($buf,4,20);
        $server_log_id_binary = substr($buf,24,4);
        //$server_log_id = current(unpack('V',$server_log_id_binary));
        $nonce = substr($buf,28);

        // @todo sample data
        $player_count = rand(0,65535);
        $gsl_ip = '127.0.0.1';
        $gsl_port = '42001';

        $send_buffer = 'pong' . $server_log_id_binary . hash('sha1', $session_id . $nonce, true) . pack('v', $player_count);

        socket_sendto(
            $udp_socket,
            $send_buffer,
            strlen($send_buffer),
            0,
            $gsl_ip,
            $gsl_port
        );

    }
}
