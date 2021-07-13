<?php

declare(strict_types=1);

namespace Test\BookingTracker;

use BookingTracker\Domain\Booking\Booking;
use BookingTracker\Domain\Booking\BookingId;
use BookingTracker\Domain\Booking\BookingInterval;

final class FakeBooking
{
    public const DATE_FORMAT = 'Y-m-d';

    public static function create(): Booking
    {
        return new Booking(
            BookingId::random(),
            FakeRoom::create(),
            FakeGuest::create(),
            BookingInterval::fromString('2021-01-01','2021-01-03')
        );
    }
}
