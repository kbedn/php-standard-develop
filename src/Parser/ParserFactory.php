<?php

namespace App\Parser;

use InvalidArgumentException;

class ParserFactory implements FactoryInterface {

    /**
     * @param string $type
     * @return ParserInterface
     */
    public function getParser(string $type): ParserInterface
    {
        return new Parser();
    }
}
