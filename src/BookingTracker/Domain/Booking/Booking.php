<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Booking;

use BookingTracker\Domain\Guest\GuestId;
use BookingTracker\Domain\Hotel\RoomId;

final class Booking
{
    public function __construct(
        private BookingId $booking_id,
        private RoomId $room_id,
        private GuestId $guest_id,
        private BookingInterval $booking_interval
    ) {}

    public function bookingId(): BookingId
    {
        return $this->booking_id;
    }

    public function roomId(): RoomId
    {
        return $this->room_id;
    }

    public function guestId(): GuestId
    {
        return $this->guest_id;
    }

    public function bookingInterval(): BookingInterval
    {
        return $this->booking_interval;
    }
}
