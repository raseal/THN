<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Hotel;

use Shared\Domain\Aggregate\AggregateRoot;

final class Hotel extends AggregateRoot
{
    public function __construct(
        private HotelId $hotel_id,
        private HotelName $hotel_name,
        private HotelAddress $hotel_address,
        private HotelUrl $hotel_url,
        private HotelAvailableRooms $available_rooms,
        private BookingsCollection $bookings_collection
    ) {}

    public function hotelId(): HotelId
    {
        return $this->hotel_id;
    }

    public function hotelName(): HotelName
    {
        return $this->hotel_name;
    }

    public function hotelAddress(): HotelAddress
    {
        return $this->hotel_address;
    }

    public function hotelUrl(): HotelUrl
    {
        return $this->hotel_url;
    }

    public function availableRooms(): HotelAvailableRooms
    {
        return $this->available_rooms;
    }

    public function bookingsCollection(): BookingsCollection
    {
        return $this->bookings_collection;
    }
}
