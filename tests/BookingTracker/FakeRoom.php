<?php

declare(strict_types=1);

namespace Test\BookingTracker;

use BookingTracker\Domain\Hotel\HotelId;
use BookingTracker\Domain\Hotel\Room\Room;
use BookingTracker\Domain\Hotel\Room\RoomId;
use BookingTracker\Domain\Hotel\Room\RoomType;

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
