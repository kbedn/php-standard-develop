<?php

namespace App\Command;

use App\Exception\InvalidParserException;
use InvalidArgumentException;
use Symfony\Component\Console\{
    Helper\Table,
    Command\Command,
    Input\InputArgument,
    Input\InputInterface,
    Output\OutputInterface,
    Style\SymfonyStyle,
};
use App\Supplier\FactoryInterface as SupplierFactoryInterface;

class SupplierSyncCommand extends Command
{
    protected static $defaultName = 'divante:supplier-sync';

    /** @var SupplierFactoryInterface  */
    private SupplierFactoryInterface $supplierFactory;

    /**
     * @param SupplierFactoryInterface $supplierFactory
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function __construct(SupplierFactoryInterface $supplierFactory)
    {
        parent::__construct(self::$defaultName);

        $this->supplierFactory = $supplierFactory;
    }

    protected function configure(): void
    {
        $this->setDescription('Synchronises a given supplier')
            ->addArgument(
                'supplier',
                InputArgument::REQUIRED,
                'Which supplier do you want to synchronize?'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument('supplier');
        $io->info('Synchronising supplier ' . $name);

        try {
            //#TODO Get the products
            $this->supplierFactory->getSupplier($name);
            $products = [];

            $table = new Table($output);
            $table->setHeaders(array('ID', 'Name', 'Desc'))->setRows($products);
            $table->render();

        } catch (InvalidArgumentException | InvalidParserException $exception) {
            $output->writeln('<!--suppress HtmlUnknownTag, HtmlUnknownTag -->
<error>' . $exception->getMessage() . '</error>');
        }

        $io->success('Done!');
        return Command::SUCCESS;
    }
}
