<?php

declare(strict_types=1);

namespace Test\BookingTracker\Application\Hotel;

use BookingTracker\Application\Hotel\FindOneHotelService;
use BookingTracker\Domain\Hotel\HotelDoesNotExist;
use BookingTracker\Domain\Hotel\HotelId;
use BookingTracker\Domain\Hotel\HotelReadModel;
use PHPUnit\Framework\TestCase;
use Test\BookingTracker\FakeHotel;

class FindOneHotelServiceTest extends TestCase
{
    private HotelReadModel $hotel_read_model;
    private HotelId $hotel_id;

    public function setUp(): void
    {
        $this->hotel_read_model = $this->createMock(HotelReadModel::class);
        $this->hotel_id = $this->createMock(HotelId::class);
    }

    /** @test */
    public function it_should_find_an_hotel(): void
    {
        $hotel = FakeHotel::create();

        $this->hotel_read_model->expects(self::once())
            ->method('findById')
            ->willReturn($hotel);

        $service = new FindOneHotelService($this->hotel_read_model);
        $service->__invoke($this->hotel_id);
    }

    /** @test */
    public function it_should_throw_exception_on_inexistent_hotel(): void
    {
        $this->expectException(HotelDoesNotExist::class);

        $this->hotel_read_model->expects(self::once())
            ->method('findById')
            ->willReturn(null);

        $service = new FindOneHotelService($this->hotel_read_model);
        $service->__invoke($this->hotel_id);
    }
}
