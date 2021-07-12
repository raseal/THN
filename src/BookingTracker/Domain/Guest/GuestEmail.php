<?php

declare(strict_types=1);

namespace BookingTracker\Domain\Guest;

use InvalidArgumentException;
use Shared\Domain\ValueObject\StringValueObject;
use function sprintf;

final class GuestEmail extends StringValueObject
{
    public function __construct(string $email)
    {
        $this->ensureValidEmail($email);
        parent::__construct($email);
    }

    private function ensureValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf(
                    'The provided email is not valid: %s',
                    $email
                )
            );
        }
    }
}
