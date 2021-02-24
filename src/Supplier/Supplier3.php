<?php

namespace App\Supplier;

use App\Event\GetProductsEvent;
use App\Event\IntegrationEvents;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class Supplier3 extends SupplierAbstract
{
    public static function getName(): string
    {
        return 'supplier3';
    }

    public static function getResponseType(): string
    {
        return 'yaml';
    }

    /**
     * @return array
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     */
    protected function parseResponse(): array
    {
        $encoder = new JsonEncoder();
        $products = $encoder->decode($this->getResponse(), self::getResponseType())['list'];

        if ($products) {
            $this->dispatchEvent($products);
        }

        return $products;
    }

    /**
     * @return string
     */
    protected function getResponse(): string
    {
        return file_get_contents('https://127.0.0.1:8000/suppliers/supplier3.json');
    }
}
