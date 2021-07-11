<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use function sprintf;

abstract class UuidValueObject extends StringValueObject
{
    public function __construct(string $uuid)
    {
        $this->ensureValidUuid($uuid);
        parent::__construct($uuid);
    }

    public static function random(): self
    {
        return new static (Uuid::uuid4()->toString());
    }


    private function ensureValidUuid(string $uuid): void
    {
        if (!Uuid::isValid($uuid)) {
            throw new InvalidArgumentException(
                sprintf(
                    'The provided identifier is not valid: %s',
                    $uuid
                )
            );
        }
    }
}
