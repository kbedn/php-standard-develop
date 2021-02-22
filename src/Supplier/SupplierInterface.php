<?php

namespace App\Supplier;

use Symfony\Component\EventDispatcher\EventDispatcher;

interface SupplierInterface
{
    public function __construct(EventDispatcher $eventDispatcher);

    public function getProducts(): array;

    public static function getName(): string;

    public static function getResponseType(): string;
}
