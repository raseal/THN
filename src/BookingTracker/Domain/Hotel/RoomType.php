<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Hotel;

use Shared\Domain\ValueObject\StringValueObject;
use function in_array;

final class RoomType extends StringValueObject
{
    private const VALID_TYPES = [
        'single',
        'double',
        'suite',
    ];

    public function __construct(string $room_type)
    {
        $this->ensureValidType($room_type);
        parent::__construct($room_type);
    }

    private function ensureValidType(string $room_type): void
    {
        if (!in_array($room_type, self::VALID_TYPES)) {
            throw new InvalidRoomType($room_type);
        }
    }
}
