<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Hotel;

use Shared\Domain\Aggregate\Collection;

final class HotelsCollection extends Collection
{
    protected function type(): string
    {
        return Hotel::class;
    }
}
