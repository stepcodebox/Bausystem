<?php

namespace Bausystem;

use Bausystem\Helper\Param;
use Assert\Assert;
use Assert\LazyAssertionException;
use Exception;
use GlobIterator;
use SplFileInfo;

class Filesystem {

    /**
     * Collects a list of files based on glob strings (like /home/user/Backups/*.tgz)
     *
     * @param string or array of strings
     *
     * @return array of strings
     */
    public static function collectFiles(array|string $param) {
        $paths = Param::getStringsParam($param);

        $results = [];

        foreach ($paths as $path) {
            $iterator = new GlobIterator($path);

            while ( $iterator->valid() ) {
                $results[] = $iterator->current();
                $iterator->next();
            }
        }

        return $results;
    }

    /**
     * Deletes files
     *
     * @param string or array of strings or array of SplFileInfo
     *
     * @return array of strings
     */
    public static function deleteFiles(array|string|SplFileInfo $param) {
        $paths = Param::getFilesParam($param);

        foreach ($paths as $path) {
            echo $path->getRealPath() . PHP_EOL;
        }
    }

}
