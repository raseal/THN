<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Hotel;

interface HotelReadModel
{
    public function findById(HotelId $hotel_id): ?Hotel;
}
