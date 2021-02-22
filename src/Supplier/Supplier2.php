<?php

namespace App\Supplier;

use Symfony\Component\Serializer\Encoder\XmlEncoder;

class Supplier2 extends SupplierAbstract
{
    public static function getName(): string
    {
        return 'supplier2';
    }

    /**
     * @return array
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     */
    protected function parseResponse(): array
    {
        $encoder = new XmlEncoder();

        return $encoder->decode($this->getResponse(), self::getResponseType())['item'];
    }

    /**
     * @return string
     */
    protected function getResponse(): string
    {
        return file_get_contents('https://127.0.0.1:8000/suppliers/supplier2.xml');
    }

    /**
     * @return string
     */
    public static function getResponseType(): string
    {
        return 'xml';
    }
}
