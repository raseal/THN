<?php

declare(strict_types=1);

namespace Test\BookingTracker\Application\Hotel\FindAll;

use BookingTracker\Application\Hotel\FindAll\FindAllHotelsService;
use BookingTracker\Domain\Hotel\Hotel;
use BookingTracker\Domain\Hotel\HotelReadModel;
use BookingTracker\Domain\Hotel\HotelsCollection;
use PHPUnit\Framework\TestCase;
use Test\BookingTracker\FakeHotel;

class FindAllHotelsServiceTest extends TestCase
{
    private HotelReadModel $hotel_read_model;
    private Hotel $hotel;

    public function setUp(): void
    {
        $this->hotel_read_model = $this->createMock(HotelReadModel::class);
        $this->hotel = FakeHotel::create();
    }

    /** @test */
    public function it_should_find_all_hotels(): void
    {
        $hotels_collection = new HotelsCollection([$this->hotel]);

        $this->hotel_read_model->expects(self::once())
            ->method('findAll')
            ->willReturn($hotels_collection);

        $service = new FindAllHotelsService($this->hotel_read_model);
        $service->__invoke();
    }
}
