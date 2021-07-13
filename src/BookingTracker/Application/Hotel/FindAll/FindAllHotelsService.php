<?php

declare(strict_types=1);

namespace BookingTracker\Application\Hotel\FindAll;

use BookingTracker\Domain\Hotel\HotelRepository;
use BookingTracker\Domain\Hotel\HotelsCollection;

final class FindAllHotelsService
{
    public function __construct(
        private HotelRepository $hotel_repository
    ) {}

    public function __invoke(): HotelsCollection
    {
        return $this->hotel_repository->findAll();
    }
}
