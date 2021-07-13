<?php

declare(strict_types=1);

namespace Test\BookingTracker;

use BookingTracker\Domain\Hotel\HotelId;
use BookingTracker\Domain\Hotel\Room;
use BookingTracker\Domain\Hotel\RoomId;
use BookingTracker\Domain\Hotel\RoomType;

final class FakeRoom
{
    public static function create(): Room
    {
        return new Room(
            RoomId::random(),
            HotelId::random(),
            new RoomType('single')
        );
    }
}
