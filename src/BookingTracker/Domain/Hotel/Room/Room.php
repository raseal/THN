<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Hotel\Room;

use BookingTracker\Domain\Hotel\HotelId;

final class Room
{
    public function __construct(
        private RoomId $room_id,
        private HotelId $hotel_id,
        private RoomType $room_type
    ) {}

    public function roomId(): RoomId
    {
        return $this->room_id;
    }

    public function hotelId(): HotelId
    {
        return $this->hotel_id;
    }

    public function roomType(): RoomType
    {
        return $this->room_type;
    }
}
