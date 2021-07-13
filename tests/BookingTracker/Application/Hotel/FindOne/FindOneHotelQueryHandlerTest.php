<?php

declare(strict_types=1);

namespace Test\BookingTracker\Application\Hotel\FindOne;

use BookingTracker\Application\Hotel\FindOne\FindOneHotelQuery;
use BookingTracker\Application\Hotel\FindOne\FindOneHotelQueryHandler;
use BookingTracker\Application\Hotel\FindOne\FindOneHotelService;
use BookingTracker\Domain\Hotel\HotelId;
use PHPUnit\Framework\TestCase;
use Test\BookingTracker\FakeHotel;

class FindOneHotelQueryHandlerTest extends TestCase
{
    private FindOneHotelQuery $query;
    private FindOneHotelService $find_one_hotel_service;

    public function setUp(): void
    {
        $this->query = new FindOneHotelQuery(HotelId::random()->value());
        $this->find_one_hotel_service = $this->createMock(FindOneHotelService::class);
    }

    /** @test */
    public function it_should_create_a_response_when_finding_a_hotel(): void
    {
        $hotel = FakeHotel::create();

        $this->find_one_hotel_service->expects(self::once())
            ->method('__invoke')
            ->willReturn($hotel);

        $handler = new FindOneHotelQueryHandler($this->find_one_hotel_service);
        $response = $handler->__invoke($this->query);

        $this->assertEquals($hotel->hotelId()->value(), $response->hotelId());
        $this->assertEquals($hotel->hotelName()->value(), $response->hotelName());
        $this->assertEquals($hotel->hotelAddress()->value(), $response->hotelAddress());
        $this->assertEquals($hotel->hotelUrl()->value(), $response->hotelUrl());
        $this->assertEquals($hotel->availableRooms()->value(), $response->availableRooms());
        $this->assertCount($hotel->bookingsCollection()->count(), $response->bookings());
        $this->assertEquals(FakeHotel::toArray($hotel), $response->jsonSerialize());
    }
}
