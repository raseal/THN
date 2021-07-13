<?php

declare(strict_types=1);

namespace BookingTracker\Application\Hotel\FindOne;

use BookingTracker\Domain\Hotel\Hotel;
use BookingTracker\Domain\Hotel\HotelDoesNotExist;
use BookingTracker\Domain\Hotel\HotelId;
use BookingTracker\Domain\Hotel\HotelReadModel;

final class FindOneHotelService
{
    public function __construct(
        private HotelReadModel $hotel_read_model
    ) {}

    public function __invoke(HotelId $hotel_id): Hotel
    {
        $hotel = $this->hotel_read_model->findById($hotel_id);

        if (null === $hotel) {
            throw new HotelDoesNotExist($hotel_id);
        }

        return $hotel;
    }
}
