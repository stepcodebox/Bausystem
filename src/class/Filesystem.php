<?php

namespace Bausystem;

use Assert\Assert;
use Assert\LazyAssertionException;
use Exception;

class Filesystem {

    // TODO: can be a string
    public static function collectFiles(array $paths) {
        $results = [];

        foreach ($paths as $path) {
            if ( is_dir($path) ) {
                $files = array_diff( scandir($path), ['..', '.'] );

                foreach ($files as $file) {
                    $results[] = "$path/$file";
                }
            }

            return $results;
        }
    }

}
