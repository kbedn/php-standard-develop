<?php

namespace App\Supplier;

use Symfony\Component\Serializer\Encoder\YamlEncoder;

class Supplier3 extends SupplierAbstract
{
    public static function getName(): string
    {
        return 'supplier1';
    }

    public static function getResponseType(): string
    {
        return 'yaml';
    }

    protected function parseResponse(): array
    {
        $encoder = new YamlEncoder();
        return $encoder->decode($this->getResponse(), self::getResponseType());
    }

    protected function getResponse(): string
    {
        return file_get_contents('http://localhost/suppliers/supplier3.yaml');
    }
}
