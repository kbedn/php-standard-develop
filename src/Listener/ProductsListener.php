<?php

namespace App\Listener;

use App\Event\GetProductsEvent;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Symfony\Contracts\EventDispatcher\Event;

class ProductsListener
{
    public const FILENAME_PATH = './var/log/supplier.log';

    /** @var LoggerInterface|Logger  */
    protected LoggerInterface $logger;

    /**
     * @param LoggerInterface|null $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger ?? new Logger(
                'suppliers_logger',
                [new StreamHandler(self::FILENAME_PATH, Logger::INFO)]
            );
    }

    /**
     * @param Event $event
     * @return bool
     */
    public function logProducts(Event $event): bool
    {
        if ($event instanceof GetProductsEvent) {
            foreach ($event->getProducts() as $product) {
                $productKeys = array_keys($product);
                $this->logger->info(
                    'Product added: ' . $product[$productKeys[0]],
                    ['supplier' => $event->getSupplierName()]
                );
            }
        }

        return true;
    }
}
