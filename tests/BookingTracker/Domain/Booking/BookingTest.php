<?php

declare(strict_types=1);

namespace Test\BookingTracker\Domain\Booking;

use BookingTracker\Domain\Booking\Booking;
use BookingTracker\Domain\Booking\BookingId;
use BookingTracker\Domain\Booking\BookingInterval;
use BookingTracker\Domain\Guest\Guest;
use BookingTracker\Domain\Guest\GuestEmail;
use BookingTracker\Domain\Guest\GuestFullName;
use BookingTracker\Domain\Guest\GuestId;
use BookingTracker\Domain\Hotel\HotelId;
use BookingTracker\Domain\Hotel\Room;
use BookingTracker\Domain\Hotel\RoomId;
use BookingTracker\Domain\Hotel\RoomType;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BookingTest extends TestCase
{
    private BookingId $booking_id;
    private Room $room;
    private Guest $guest;

    public function setUp(): void
    {
        $this->booking_id = BookingId::random();
        $this->room = new Room(RoomId::random(), HotelId::random(), new RoomType('single'));
        $this->guest = new Guest(GuestId::random(), new GuestFullName('Edward Elric'), new GuestEmail('edward.elric@fma.com'));
    }

    /** @test */
    public function it_should_create_a_valid_booking(): void
    {
        $interval = BookingInterval::fromString('2021-03-12','2021-03-15');

        $booking = new Booking($this->booking_id, $this->room, $this->guest, $interval);
        self::assertTrue($booking->bookingId()->equals($this->booking_id));
        self::assertEquals('single', $booking->room()->roomType()->value());
        self::assertEquals('edward.elric@fma.com', $booking->guest()->email()->value());
        self::assertTrue($booking->bookingInterval()->equals($interval));
    }

    /** @test */
    public function it_should_throw_an_exception_on_invalid_interval(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $invalid_interval = BookingInterval::fromString('2021-10-12','2021-03-15');
        new Booking($this->booking_id, $this->room, $this->guest, $invalid_interval);
    }
}
