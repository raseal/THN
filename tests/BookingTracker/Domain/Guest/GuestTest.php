<?php

declare(strict_types=1);

namespace Test\BookingTracker\Domain\Guest;

use BookingTracker\Domain\Guest\Guest;
use BookingTracker\Domain\Guest\GuestEmail;
use BookingTracker\Domain\Guest\GuestFullName;
use BookingTracker\Domain\Guest\GuestId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class GuestTest extends TestCase
{
    /** @test */
    public function it_should_create_a_valid_guest(): void
    {
        $id = GuestId::random();
        $fullname = new GuestFullName('Jack Torrance');
        $email = new GuestEmail('jack@torrance.net');

        $guest = new Guest($id, $fullname, $email);

        self::assertTrue($guest->guestId()->equals($id));
        self::assertTrue($guest->fullName()->equals($fullname));
        self::assertTrue($guest->email()->equals($email));
    }

    /** @test */
    public function it_should_throw_an_exception_on_invalid_email(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $id = GuestId::random();
        $fullname = new GuestFullName('Mr. Bad Email');
        $email = new GuestEmail('i dunno what an email is');

        new Guest($id, $fullname, $email);
    }
}
