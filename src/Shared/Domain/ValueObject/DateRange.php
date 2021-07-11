<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

use DateTimeImmutable;
use InvalidArgumentException;
use Throwable;
use function sprintf;

class DateRange
{
    private DateTimeImmutable $from;
    private DateTimeImmutable $to;

    public function __construct(DateTimeImmutable $from, DateTimeImmutable $to)
    {
        $this->ensureValidrange($from, $to);
        $this->from = $from;
        $this->to = $to;
    }

    public static function fromString(string $from, string $to): self
    {
        try {
            $start = new DateTimeImmutable($from);
            $end = new DateTimeImmutable($to);

            return new static($start, $end);
        } catch(Throwable) {
            throw new InvalidArgumentException( 'The date provided is not valid');
        }
    }

    public function from(): DateTimeImmutable
    {
        return $this->from;
    }

    public function to(): DateTimeImmutable
    {
        return $this->to;
    }

    public function equals(self $interval): bool
    {
        return ($this->from() == $interval->from() && $this->to() == $interval->to());
    }

    private function ensureValidRange(DateTimeImmutable $from, DateTimeImmutable $to): void
    {
        if ($from > $to) {
            throw new InvalidArgumentException(
                sprintf(
                    'The date interval is not valid ("%s" should be lesser than "%s")',
                    $from->format('Y-m-d H:i:s'),
                    $to->format('Y-m-d H:i:s')
                )
            );
        }
    }
}
