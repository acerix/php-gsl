<?php

use Composer\Autoload\ClassLoader;

$autoload_path =  __DIR__ . "/../vendor/autoload.php";
$loader = require($autoload_path);

/**
 * @var $loader ClassLoader
 */
$loader->add('DrSlump\Protobuf\Test', __DIR__ . DIRECTORY_SEPARATOR . "library");
$loader->add('DrSlump',  __DIR__ . DIRECTORY_SEPARATOR . "generated");