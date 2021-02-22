<?php

namespace App\Supplier;

use Symfony\Component\Serializer\Encoder\XmlEncoder;

class Supplier1 extends SupplierAbstract
{
    public static function getName(): string
    {
        return 'supplier1';
    }

    protected function getResponse(): string
    {
        return file_get_contents('http://localhost/suppliers/supplier1.xml');
    }

    protected function parseResponse(): array
    {
        $encoder = new XmlEncoder();
        return $encoder->decode($this->getResponse(), self::getResponseType());
    }

    public static function getResponseType(): string
    {
        return 'xml';
    }
}
