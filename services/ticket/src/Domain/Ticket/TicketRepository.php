<?php
declare(strict_types=1);

namespace Ticket\Domain\Ticket;

use Ticket\Domain\Category\CategoryId;
use Ticket\Domain\Exception\TicketNotFound;

interface TicketRepository
{
    public function nextIdentity(): TicketId;

    public function add(Ticket $ticket): void;

    /**
     * @param TicketId $id
     * @return Ticket
     * @throws TicketNotFound
     */
    public function getById(TicketId $id): Ticket;

    /**
     * @param TicketId ...$ids
     * @return Ticket[]
     */
    public function getByIds(TicketId ...$ids): array;

    /**
     * @param CategoryId $categoryId
     * @return Ticket[]
     */
    public function getByCategory(CategoryId $categoryId): array;
}