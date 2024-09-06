<?php

namespace Ntriga\OptimizeDbTables\MessageHandler;

use Doctrine\DBAL\Connection;
use Ntriga\OptimizeDbTables\Message\OptimizeTableMessage;
use PDO;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class OptimizeTableMessageHandler
{
    public function __construct(
        private readonly Connection $connection,
    ){}

    public function __invoke(OptimizeTableMessage $message): void
    {
        dump('Optimizing table: ' . $message->getTable());

        $pdo = $this->connection->getWrappedConnection();
        $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $stmt = $pdo->prepare('OPTIMIZE TABLE ' . $message->getTable());
        $stmt->execute();
    }
}