<?php
declare(strict_types=1);

namespace Ticket\Infrastructure\Application;

use Ticket\Application\Query\Handler;
use Ticket\Application\Query\Query;
use Ticket\Application\QueryBus;

class SimpleQueryBus implements QueryBus
{
    private array $handlers = [];

    public function map(string $query, Handler $handler): void
    {
        if (!class_exists($query)) {
            throw new \RuntimeException('Query class does not exist.');
        }

        $this->handlers[$query] = $handler;
    }

    public function handle(Query $query)
    {
        if (!array_key_exists(get_class($query), $this->handlers)) {
            throw new \RuntimeException('There is no any configured handler for provided query.');
        }

        /** @var Handler $handler */
        $handler = $this->handlers[get_class($query)];
        return $handler->handle($query);
    }
}