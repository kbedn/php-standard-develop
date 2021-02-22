<?php

namespace App\Supplier;

use InvalidArgumentException;

interface FactoryInterface
{
    /**
     * @param string $supplierName
     * @return SupplierInterface
     * @throws InvalidArgumentException
     */
    public function getSupplier(string $supplierName): SupplierInterface;
}
