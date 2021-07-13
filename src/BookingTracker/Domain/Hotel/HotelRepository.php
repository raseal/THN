<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Hotel;

interface HotelRepository
{
    public function findById(HotelId $hotel_id): ?Hotel;

    public function findAll(): HotelsCollection;
}
