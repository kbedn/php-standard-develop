<?php

namespace App\Parser;

use InvalidArgumentException;

interface FactoryInterface
{
    /**
     * @param string $type
     * @return ParserInterface
     * @throws InvalidArgumentException
     */
    public function getParser(string $type): ParserInterface;
}
