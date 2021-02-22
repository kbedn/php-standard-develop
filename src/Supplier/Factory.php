<?php

namespace App\Supplier;

use App\Event\IntegrationEvents;
use App\Listener\ProductsListener;
use App\Parser\FactoryInterface as ParserFactoryInterface;
use InvalidArgumentException;
use ReflectionClass;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class Factory implements FactoryInterface
{
    use ClassResolverTrait;

    protected const SUPPLIER_1 = 'supplier1';
    protected const SUPPLIER_2 = 'supplier2';
    protected const SUPPLIER_3 = 'supplier3';

    /** @var ParserFactoryInterface|null */
    protected ?ParserFactoryInterface $parserFactory = null;

    /** @var EventDispatcherInterface  */
    protected EventDispatcherInterface $eventDispatcher;

    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        ParserFactoryInterface $parserFactory = null
    ) {
        if($parserFactory !== null) {
            $this->parserFactory = $parserFactory;
        }
        $this->eventDispatcher = $eventDispatcher;

        $this->eventDispatcher->addListener(
            IntegrationEvents::SUPPLIER_GET_PRODUCTS,
            [new ProductsListener(), 'logProducts']
        );
    }

    /**
     * @param string $supplierName
     * @return SupplierInterface
     */
    public function getSupplier(string $supplierName): SupplierInterface
    {
            if (!class_exists($supplierName) && !interface_exists($supplierName, false)) {
                throw newInvalidArgumentException(sprintf('The class or interface "%s" does not exist.', $supplierName));
            }
            $supplier = new $supplierName;
            if ($supplier instanceof SupplierAbstract) {
                return $supplier;
            }
    }


    /**
     * @return array
     */
    public static function getConstants(): array {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
}
