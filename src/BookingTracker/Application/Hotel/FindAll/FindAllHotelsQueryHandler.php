<?php

declare(strict_types=1);

namespace BookingTracker\Application\Hotel\FindAll;

use BookingTracker\Application\Hotel\HotelsCollectionResponse;
use Shared\Domain\Bus\Query\QueryHandler;

final class FindAllHotelsQueryHandler implements QueryHandler
{
    public function __construct(
        private FindAllHotelsService $find_all_hotels_service
    ) {}

    public function __invoke(FindAllHotelsQuery $query): HotelsCollectionResponse
    {
        $hotels_collection = $this->find_all_hotels_service->__invoke();

        return HotelsCollectionResponse::fromHotelsCollection($hotels_collection);
    }
}
