<?php

declare(strict_types=1);

namespace Test\BookingTracker\Application\Hotel\FindOne;

use BookingTracker\Application\Hotel\FindOne\FindOneHotelService;
use BookingTracker\Domain\Hotel\HotelDoesNotExist;
use BookingTracker\Domain\Hotel\HotelId;
use BookingTracker\Domain\Hotel\HotelRepository;
use PHPUnit\Framework\TestCase;
use Test\BookingTracker\FakeHotel;

class FindOneHotelServiceTest extends TestCase
{
    private HotelRepository $hotel_repository;
    private HotelId $hotel_id;

    public function setUp(): void
    {
        $this->hotel_repository = $this->createMock(HotelRepository::class);
        $this->hotel_id = $this->createMock(HotelId::class);
    }

    /** @test */
    public function it_should_find_an_hotel(): void
    {
        $hotel = FakeHotel::create();

        $this->hotel_repository->expects(self::once())
            ->method('findById')
            ->willReturn($hotel);

        $service = new FindOneHotelService($this->hotel_repository);
        $service->__invoke($this->hotel_id);
    }

    /** @test */
    public function it_should_throw_exception_on_inexistent_hotel(): void
    {
        $this->expectException(HotelDoesNotExist::class);

        $this->hotel_repository->expects(self::once())
            ->method('findById')
            ->willReturn(null);

        $service = new FindOneHotelService($this->hotel_repository);
        $service->__invoke($this->hotel_id);
    }
}
