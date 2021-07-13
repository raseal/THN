<?php

declare(strict_types=1);

namespace Test\BookingTracker\Domain\Hotel;

use BookingTracker\Domain\Hotel\HotelId;
use BookingTracker\Domain\Hotel\Room\InvalidRoomType;
use BookingTracker\Domain\Hotel\Room\Room;
use BookingTracker\Domain\Hotel\Room\RoomId;
use BookingTracker\Domain\Hotel\Room\RoomType;
use PHPUnit\Framework\TestCase;

class RoomTest extends TestCase
{
    private RoomId $room_id;
    private HotelId $hotel_id;

    public function setUp(): void
    {
        $this->room_id = RoomId::random();
        $this->hotel_id = HotelId::random();
    }

    /** @test */
    public function it_should_create_a_valid_room(): void
    {
        $room_type = new RoomType('single');

        $room = new Room($this->room_id, $this->hotel_id, $room_type);

        self::assertTrue($room->roomId()->equals($this->room_id));
        self::assertTrue($room->hotelId()->equals($this->hotel_id));
        self::assertTrue($room->roomType()->equals($room_type));
    }

    /** @test */
    public function it_should_throw_an_exception_on_invalid_room_type(): void
    {
        $this->expectException(InvalidRoomType::class);

        $bad_room_type = new RoomType('bad type');

        new Room($this->room_id, $this->hotel_id, $bad_room_type);
    }
}
