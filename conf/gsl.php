<?php

$gsl_config = array(

    // GSL Annount URL
    'announce_url' => 'http://gsl.pow7.com/announce/',

    // IP and port of GSL pong server
    'pong_ip' => '69.172.205.90',
    'pong_port' => 42001,

    // Format for exporting data: MessagePack, JSON, or both
    'generate_msgpack' => function_exists('msgpack_pack'), // better for production, needs msgpack.so
    'generate_json' => TRUE, // helpful for debugging

);
