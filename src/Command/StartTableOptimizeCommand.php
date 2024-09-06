<?php

namespace Ntriga\OptimizeDbTables\Command;

use Doctrine\DBAL\Connection;
use Ntriga\OptimizeDbTables\Message\OptimizeTableMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'ntriga:pimcore-optimize-db-tables'
)]
class StartTableOptimizeCommand extends Command
{
    public function __construct(
        private readonly Connection $connection,
        private readonly MessageBusInterface $messageBus
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Dispatching messages to optimize tables...');

        // Get all the tables from the DB
        $tables = $this->connection->executeQuery('SHOW TABLES')->fetchAllAssociative();

        // Loop over the tables and dispatch the message optimize them
        foreach ($tables as $table) {
            $tableName = current($table);
            $this->messageBus->dispatch(new OptimizeTableMessage($tableName));
        }

        $output->writeln('Messages dispatched.');

        return self::SUCCESS;
    }
}