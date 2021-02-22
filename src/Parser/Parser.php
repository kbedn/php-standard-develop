<?php

namespace App\Parser;

use App\Exception\InvalidParserException;
use App\Supplier\SupplierInterface;

class Parser implements ParserInterface 
{
    /**
     * @var SupplierInterface|null
     */
    public ?SupplierInterface $supplier;

    /**
     * @param SupplierInterface|null $supplier
     */
    public function __construct(SupplierInterface $supplier = null)
    {
        $this->supplier = $supplier;
    }

    /**
     * @param string $content
     * @return array
     */
    public function parse(string $content): array
    {
        try {
            return $this->supplier->getProducts();
        } catch (InvalidParserException $exception) {
        }

        return [];
    }

    /**
     * @return string
     */
    public static function getType(): string
    {
        return SupplierInterface::getResponseType();
    }
}
