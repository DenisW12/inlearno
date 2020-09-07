<?php

require_once __DIR__.'/vendor/autoload.php';

set_error_handler(function(int $errno, string $errstr, string $errfile, int $errline) {
    throw new \RuntimeException('Error: '.$errstr.' in '.$errfile.' on line '.$errline);
});