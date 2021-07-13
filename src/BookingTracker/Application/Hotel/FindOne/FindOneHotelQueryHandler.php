<?php

declare(strict_types=1);

namespace BookingTracker\Application\Hotel\FindOne;

use BookingTracker\Application\Hotel\HotelResponse;
use BookingTracker\Domain\Hotel\HotelId;
use Shared\Domain\Bus\Query\QueryHandler;

final class FindOneHotelQueryHandler implements QueryHandler
{
    public function __construct(
        private FindOneHotelService $find_one_hotel_service
    ) {}

    public function __invoke(FindOneHotelQuery $query): HotelResponse
    {
        $hotel_id = new HotelId($query->id());

        $hotel = $this->find_one_hotel_service->__invoke($hotel_id);

        return HotelResponse::fromHotel($hotel);
    }
}
