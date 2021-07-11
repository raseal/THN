<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Guest;

final class Guest
{
    public function __construct(
        private GuestId $guest_id,
        private GuestFullName $full_name,
        private GuestEmail $email
    ) {}

    public function guestId(): GuestId
    {
        return $this->guest_id;
    }

    public function fullName(): GuestFullName
    {
        return $this->full_name;
    }

    public function email(): GuestEmail
    {
        return $this->email;
    }
}
