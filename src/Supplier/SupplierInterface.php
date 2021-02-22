<?php

namespace App\Supplier;

use App\Exception\InvalidParserException;
use App\Parser\ParserInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

interface SupplierInterface
{
    public function __construct(
        ParserInterface $parser,
        EventDispatcher $eventDispatcher,
        EncoderInterface $serializer
    );

    /**
     * @return array
     * @throws InvalidParserException
     */
    public function getProducts(): array;

    public static function getName(): string;

    public static function getResponseType(): string;
}
