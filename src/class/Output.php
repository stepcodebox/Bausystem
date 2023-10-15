<?php

namespace Bausystem;

/**
 * A class for printing text to the command line
 */
class Output {

    public static function error($text) {
        echo "\033[01;31m$text\033[0m" . PHP_EOL;
    }

    public static function success($text) {
        echo "\033[00;32m$text\033[0m" . PHP_EOL;
    }

}
