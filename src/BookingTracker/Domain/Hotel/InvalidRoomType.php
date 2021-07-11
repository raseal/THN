<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Hotel;

use Shared\Domain\DomainError;
use function sprintf;

final class InvalidRoomType extends DomainError
{
    private string $invalid_room_type;

    public function __construct(string $invalid_room_type)
    {
        $this->invalid_room_type = $invalid_room_type;
        parent::__construct();
    }

    public function errorMessage(): string
    {
        return sprintf(
            'The specified room type is invalid: %s',
            $this->invalid_room_type
        );
    }
}
