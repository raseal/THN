<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

abstract class StringValueObject
{
    public function __construct(
        private string $value
    ) {}

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $value): bool
    {
        return $this->value() === $value->value();
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
