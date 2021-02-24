<?php

namespace App\Supplier;

use App\{
    Event\GetProductsEvent,
    Event\IntegrationEvents
};
use Exception;
use Symfony\Component\EventDispatcher\EventDispatcher;

abstract class SupplierAbstract implements SupplierInterface
{
    /** @var EventDispatcher */
    protected EventDispatcher $eventDispatcher;

    /**
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->parseResponse();
    }

    public function dispatchEvent(array $products): void
    {
        $this->eventDispatcher->dispatch(
            new GetProductsEvent($products, $this->getName()),
            IntegrationEvents::SUPPLIER_GET_PRODUCTS
        );
    }

    /**
     * @return array
     * @throws Exception
     */
    abstract protected function parseResponse(): array;
}
