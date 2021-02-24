<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class SupplierSyncTest extends KernelTestCase
{
    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \Symfony\Component\Console\Exception\CommandNotFoundException
     */
    final public function testExecute(): void
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('divante:supplier-sync');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'supplier' => 'Supplier1',
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Done', $output);
    }
}
