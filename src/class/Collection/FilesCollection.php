<?php

namespace Bausystem\Collection;

use Assert\Assert;
use Assert\LazyAssertionException;
use Bausystem\Collection;
use Exception;
use SplFileInfo;

class FilesCollection extends Collection {

    public function __construct(array|string $param) {
        $array = [];

        if ( !empty($param) ) {
            if ( is_array($param) ) {
                foreach ($param as $item) {
                    if ( $item instanceof SplFileInfo ) {
                        $array[] = $item;
                    } else {
                        throw new Exception('$item isn\'t instance of SplFileInfo class');
                    }
                }

            } elseif ( $param instanceof SplFileInfo ) {
                $array[] = $param;
            }
        }

        parent::__construct($param);
    }

    public function current(): ?SplFileInfo {
        return $this->array[ $this->position ];
    }

}
