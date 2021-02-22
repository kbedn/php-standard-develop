<?php

namespace App\Parser;

use App\Exception\InvalidParserException;

interface ParserInterface
{
    public static function getType(): string;

    /**
     * @param string $content
     * @return array
     * @throws InvalidParserException
     */
    public function parse(string $content): array;
}
