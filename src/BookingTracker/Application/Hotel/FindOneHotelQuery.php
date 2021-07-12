<?php

declare(strict_types=1);

namespace BookingTracker\Application\Hotel;

use Shared\Domain\Bus\Query\Query;

final class FindOneHotelQuery implements Query
{
    public function __construct(
        private string $id
    ) {}

    public function id(): string
    {
        return $this->id;
    }
}
