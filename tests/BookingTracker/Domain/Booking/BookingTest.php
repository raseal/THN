<?php

declare(strict_types=1);

namespace Test\BookingTracker\Domain\Booking;

use BookingTracker\Domain\Booking\Booking;
use BookingTracker\Domain\Booking\BookingId;
use BookingTracker\Domain\Booking\BookingInterval;
use BookingTracker\Domain\Guest\GuestId;
use BookingTracker\Domain\Hotel\RoomId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BookingTest extends TestCase
{
    private BookingId $booking_id;
    private RoomId $room_id;
    private GuestId $guest_id;

    public function setUp(): void
    {
        $this->booking_id = BookingId::random();
        $this->room_id = RoomId::random();
        $this->guest_id = GuestId::random();
    }

    /** @test */
    public function it_should_create_a_valid_booking(): void
    {
        $interval = BookingInterval::fromString('2021-03-12','2021-03-15');

        $booking = new Booking($this->booking_id, $this->room_id, $this->guest_id, $interval);
        self::assertTrue($booking->bookingId()->equals($this->booking_id));
        self::assertTrue($booking->roomId()->equals($this->room_id));
        self::assertTrue($booking->guestId()->equals($this->guest_id));
        self::assertTrue($booking->bookingInterval()->equals($interval));
    }

    /** @test */
    public function it_should_throw_an_exception_on_invalid_interval(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $invalid_interval = BookingInterval::fromString('2021-10-12','2021-03-15');
        new Booking($this->booking_id, $this->room_id, $this->guest_id, $invalid_interval);
    }
}
