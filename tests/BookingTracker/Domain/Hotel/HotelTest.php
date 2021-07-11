<?php

declare(strict_types=1);

namespace Test\BookingTracker\Domain\Hotel;

use BookingTracker\Domain\Hotel\BookingsCollection;
use BookingTracker\Domain\Hotel\HotelAvailableRooms;
use BookingTracker\Domain\Hotel\Hotel;
use BookingTracker\Domain\Hotel\HotelAddress;
use BookingTracker\Domain\Hotel\HotelId;
use BookingTracker\Domain\Hotel\HotelName;
use BookingTracker\Domain\Hotel\HotelUrl;
use PHPUnit\Framework\TestCase;

class HotelTest extends TestCase
{
    /** @test */
    public function should_create_valid_hotel(): void
    {
        $id = HotelId::random();
        $name = new HotelName('Overlook');
        $address = new HotelAddress('Rocky Mountains');
        $url = new HotelUrl('https://here-is-johhny.com');
        $available_rooms = new HotelAvailableRooms(666);
        $bookings_collection = new BookingsCollection([]);

        $hotel = new Hotel($id, $name, $address, $url, $available_rooms, $bookings_collection);

        self::assertTrue($hotel->hotelId()->equals($id));
        self::assertTrue($hotel->hotelName()->equals($name));
        self::assertTrue($hotel->hotelAddress()->equals($address));
        self::assertTrue($hotel->hotelUrl()->equals($url));
        self::assertTrue($hotel->availableRooms()->equals($available_rooms));
        self::assertCount(0, $hotel->bookingsCollection()->items());
    }
}
