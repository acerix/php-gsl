<?php

$gsl_config = array(

    // GSL Annount URL
    'announce_url' => 'http://gsl.pow7.com/announce/',

    // IP and port of GSL pong server
    'pong_ip' => '69.172.205.90',
    'pong_port' => 42001,

    // Whether to generate BSON, JSON, or both
    'generate_bson' => TRUE, // better for production, needs mongodb currently
    'generate_json' => TRUE, // helpful for debugging

);
