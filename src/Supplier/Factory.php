<?php

namespace App\Supplier;

use App\Event\IntegrationEvents;
use App\Listener\ProductsListener;
use InvalidArgumentException;
use ReflectionClass;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class Factory implements FactoryInterface
{
    protected const SUPPLIER_1 = 'supplier1';
    protected const SUPPLIER_2 = 'supplier2';
    protected const SUPPLIER_3 = 'supplier3';

    /** @var EventDispatcherInterface */
    protected EventDispatcherInterface $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->eventDispatcher->addListener(
            IntegrationEvents::SUPPLIER_GET_PRODUCTS,
            [new ProductsListener(), 'logProducts']
        );
    }

    /**
     * @return array
     */
    public static function getConstants(): array
    {
        $oClass = new ReflectionClass(__CLASS__);

        return $oClass->getConstants();
    }

    /**
     * @param string $supplierName
     * @return SupplierInterface
     */
    public function getSupplier(string $supplierName): SupplierInterface
    {
        $supplierClass = __NAMESPACE__.'\\'.$supplierName;
        if (!class_exists($supplierClass)) {
            throw new InvalidArgumentException(
                sprintf('The class "%s" does not exist.', $supplierName)
            );
        }
        $supplier = new $supplierClass($this->eventDispatcher);
        if ($supplier instanceof SupplierAbstract) {
            return $supplier;
        }
    }
}
