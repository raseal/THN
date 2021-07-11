<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Booking;

use BookingTracker\Domain\Guest\Guest;
use BookingTracker\Domain\Hotel\Room;

final class Booking
{
    public function __construct(
        private BookingId $booking_id,
        private Room $room,
        private Guest $guest,
        private BookingInterval $booking_interval
    ) {}

    public function bookingId(): BookingId
    {
        return $this->booking_id;
    }

    public function room(): Room
    {
        return $this->room;
    }

    public function guest(): Guest
    {
        return $this->guest;
    }

    public function bookingInterval(): BookingInterval
    {
        return $this->booking_interval;
    }
}
