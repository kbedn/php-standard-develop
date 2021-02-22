<?php

namespace App\Supplier;

use Symfony\Component\Serializer\Encoder\XmlEncoder;

class Supplier2 extends SupplierAbstract
{
    public static function getName(): string
    {
        return 'supplier2';
    }

    public static function getResponseType(): string
    {
        return 'xml';
    }

    protected function parseResponse(): array
    {
        $encoder = new XmlEncoder();
        return $encoder->decode($this->getResponse(), self::getResponseType());
    }

    protected function getResponse(): string
    {
        return file_get_contents('http://localhost/suppliers/supplier2.xml');
    }
}
