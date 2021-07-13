<?php

declare(strict_types=1);

namespace BookingTracker\Application\Hotel\FindAll;

use BookingTracker\Domain\Hotel\HotelReadModel;
use BookingTracker\Domain\Hotel\HotelsCollection;

final class FindAllHotelsService
{
    public function __construct(
        private HotelReadModel $hotel_read_model
    ) {}

    public function __invoke(): HotelsCollection
    {
        return $this->hotel_read_model->findAll();
    }
}
