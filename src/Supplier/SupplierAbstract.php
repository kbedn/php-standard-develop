<?php

namespace App\Supplier;

use App\{
    Event\GetProductsEvent,
    Event\IntegrationEvents,
    Exception\InvalidParserException,
    Parser\ParserInterface
};
use Exception;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

abstract class SupplierAbstract implements SupplierInterface
{
    /** @var ParserInterface  */
    protected ParserInterface $parser;
    /** @var EventDispatcher  */
    protected EventDispatcher$eventDispatcher;
    /** @var EncoderInterface  */
    protected EncoderInterface $encoder;

    /**
     * @param ParserInterface $parser
     * @param EventDispatcher $eventDispatcher
     * @param EncoderInterface $encoder
     */
    public function __construct(
        ParserInterface $parser,
        EventDispatcher $eventDispatcher,
        EncoderInterface $encoder
    ) {
        $this->parser = $parser;
        $this->eventDispatcher = $eventDispatcher;
        $this->encoder = $encoder;
    }

    /**
     * @return array
     * @throws InvalidParserException
     */
    public function getProducts(): array
    {
        return $this->parseResponse();
    }

    /**
     * @return array
     * @throws InvalidParserException
     * @throws Exception
     */
    abstract protected function parseResponse(): array;
}
