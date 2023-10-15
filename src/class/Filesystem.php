<?php

namespace Bausystem;

use Bausystem\Helper\Param;
use Assert\Assert;
use Assert\LazyAssertionException;
use RuntimeException;
use GlobIterator;
use SplFileInfo;
use Exception;

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
    public static function deleteFiles(array|string|SplFileInfo $files, array $settings = [ 'ignore_non_existing' => true ] ): bool {
        $paths = Param::getFilesParam($files);

        foreach ($paths as $path) {
            $absolute_path = $path->getPath();

            try {
                Assert::lazy()->tryAll()
                    ->that($absolute_path)
                        ->string()
                        ->notEmpty()
                        ->notSame('/')
                        ->notSame('.')
                        ->notSame('..')
                        ->notContains('*')
                        ->notContains('?')
                        ->betweenLength(1, 4096)
                    ->verifyNow();

            } catch (LazyAssertionException $e) {
                throw new Exception($e->getMessage());

            } catch (\Throwable $e) {
                throw new Exception( "Fatal error: Invalid absolute path" . $e->getMessage() );
            }

            if ( is_file($absolute_path) ) {
                if ( @unlink($absolute_path) ) {
                    continue;
                    
                } else {
                    throw new RuntimeException('Cannot delete file: "' . $absolute_path . '"');
                }
   
            } else {
                if ( isset( $settings['ignore_non_existing'] ) && $settings['ignore_non_existing'] === false ) {
                    throw new RuntimeException('Cannot delete file: "' . $absolute_path . '". The file does not exist');
                }
            }
        }

        return true;
    }

}
