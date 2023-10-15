<?php

if (version_compare(phpversion(), '8.2', '<') == true) {
    echo 'PHP 8.2 or newer is required. Your PHP version is: ' . phpversion() . '. Exiting.' . PHP_EOL;

    exit(1);
}

set_time_limit(0);

require_once __DIR__ . '/../vendor/autoload.php';

if ( isset($config) && isset( $config['log_path'] ) ) {
    $log_path = $config['log_path'];
} else {
    $log_path = null;
}

$logger = new Bausystem\Logger($log_path);

Bausystem\ErrorHandler::init($logger);

set_exception_handler('Bausystem\ErrorHandler::exceptionHandler');