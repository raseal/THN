<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Hotel;

use Shared\Domain\DomainError;

final class HotelDoesNotExist extends DomainError
{
    private HotelId $hotel_id;

    public function __construct(HotelId $hotel_id)
    {
        $this->hotel_id = $hotel_id;
        parent::__construct();
    }

    public function errorMessage(): string
    {
        return sprintf(
            'The hotel <%s> does not exist',
            $this->hotel_id
        );
    }
}
