<?php

declare(strict_types=1);

namespace Test\BookingTracker\Application\Hotel;

use BookingTracker\Application\Hotel\FindAllHotelsQuery;
use BookingTracker\Application\Hotel\FindAllHotelsQueryHandler;
use BookingTracker\Application\Hotel\FindAllHotelsService;
use BookingTracker\Domain\Hotel\HotelsCollection;
use PHPUnit\Framework\TestCase;
use Test\BookingTracker\FakeHotel;

class FindAllHotelsQueryHandlerTest extends TestCase
{
    private FindAllHotelsQuery $query;
    private FindAllHotelsService $find_all_hotels_service;

    public function setUp(): void
    {
        $this->query = new FindAllHotelsQuery();
        $this->find_all_hotels_service = $this->createMock(FindAllHotelsService::class);
    }

    /** @test */
    public function it_should_create_a_response_collection_when_finding_hotels(): void
    {
        $hotel = FakeHotel::create();
        $collection = new HotelsCollection([$hotel]);

        $this->find_all_hotels_service->expects(self::once())
            ->method('__invoke')
            ->willReturn($collection);

        $handler = new FindAllHotelsQueryHandler($this->find_all_hotels_service);
        $response = $handler->__invoke($this->query);

        $this->assertCount($collection->count(), $response->jsonSerialize());
    }
}
