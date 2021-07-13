<?php

declare(strict_types=1);

namespace Test\BookingTracker\Application\Hotel\FindAll;

use BookingTracker\Application\Hotel\FindAll\FindAllHotelsService;
use BookingTracker\Domain\Hotel\Hotel;
use BookingTracker\Domain\Hotel\HotelRepository;
use BookingTracker\Domain\Hotel\HotelsCollection;
use PHPUnit\Framework\TestCase;
use Test\BookingTracker\FakeHotel;

class FindAllHotelsServiceTest extends TestCase
{
    private HotelRepository $hotel_repository;
    private Hotel $hotel;

    public function setUp(): void
    {
        $this->hotel_repository = $this->createMock(HotelRepository::class);
        $this->hotel = FakeHotel::create();
    }

    /** @test */
    public function it_should_find_all_hotels(): void
    {
        $hotels_collection = new HotelsCollection([$this->hotel]);

        $this->hotel_repository->expects(self::once())
            ->method('findAll')
            ->willReturn($hotels_collection);

        $service = new FindAllHotelsService($this->hotel_repository);
        $service->__invoke();
    }
}
