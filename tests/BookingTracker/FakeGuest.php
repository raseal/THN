<?php

declare(strict_types=1);

namespace Test\BookingTracker;

use BookingTracker\Domain\Guest\Guest;
use BookingTracker\Domain\Guest\GuestEmail;
use BookingTracker\Domain\Guest\GuestFullName;
use BookingTracker\Domain\Guest\GuestId;

final class FakeGuest
{
    public static function create(): Guest
    {
        return new Guest(
            GuestId::random(),
            new GuestFullName('Jack Torrance'),
            new GuestEmail('jack.torrance@overlook.com')
        );
    }
}
