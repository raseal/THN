<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Booking;

use Shared\Domain\Aggregate\Collection;

final class BookingsCollection extends Collection
{
    protected function type(): string
    {
        return Booking::class;
    }
}
