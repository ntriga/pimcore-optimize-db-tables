<?php

namespace Ntriga\OptimizeDbTables\Message;

class OptimizeTableMessage
{
    public function __construct(
        private readonly string $table,
    ) {
    }

    public function getTable(): string
    {
        return $this->table;
    }
}