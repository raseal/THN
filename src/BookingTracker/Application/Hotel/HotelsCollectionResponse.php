<?php

declare(strict_types=1);

namespace BookingTracker\Application\Hotel;

use BookingTracker\Domain\Hotel\HotelsCollection;
use JsonSerializable;
use Shared\Domain\Bus\Query\ResponseCollection;

final class HotelsCollectionResponse extends ResponseCollection implements JsonSerializable
{
    protected function type(): string
    {
        return HotelResponse::class;
    }

    public static function fromHotelsCollection(HotelsCollection $hotels): self
    {
        $items = [];

        foreach ($hotels as $hotel) {
            $items[] = HotelResponse::fromHotel($hotel);
        }

        return new self($items);
    }

    public function jsonSerialize(): array
    {
        return $this->items();
    }
}
