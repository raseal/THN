<?php

declare(strict_types=1);

namespace Test\BookingTracker\Application\Hotel;

use BookingTracker\Application\Hotel\FindOneHotelQuery;
use BookingTracker\Application\Hotel\FindOneHotelQueryHandler;
use BookingTracker\Application\Hotel\FindOneHotelService;
use BookingTracker\Domain\Hotel\BookingsCollection;
use BookingTracker\Domain\Hotel\Hotel;
use BookingTracker\Domain\Hotel\HotelAddress;
use BookingTracker\Domain\Hotel\HotelAvailableRooms;
use BookingTracker\Domain\Hotel\HotelId;
use BookingTracker\Domain\Hotel\HotelName;
use BookingTracker\Domain\Hotel\HotelUrl;
use PHPUnit\Framework\TestCase;

class FindOneHotelQueryHandlerTest extends TestCase
{
    private FindOneHotelQuery $query;
    private FindOneHotelService $find_one_hotel_service;
    private string $hotel_id;
    private string $name;
    private string $address;
    private string $url;
    private int $available_rooms;
    private array $bookings_collection;

    public function setUp(): void
    {
        $this->query = new FindOneHotelQuery(HotelId::random()->value());
        $this->find_one_hotel_service = $this->createMock(FindOneHotelService::class);
        $this->hotel_id = HotelId::random()->value();
        $this->name = 'Overlook';
        $this->address = 'Rocky Mountains, Colorado';
        $this->url = 'https://here-is-johhny.com';
        $this->available_rooms = 666;
        $this->bookings_collection = [];
    }

    /** @test */
    public function it_should_create_a_response_when_finding_a_hotel(): void
    {
        $hotel = $this->createHotel();

        $this->find_one_hotel_service->expects(self::once())
            ->method('__invoke')
            ->willReturn($hotel);

        $handler = new FindOneHotelQueryHandler($this->find_one_hotel_service);
        $response = $handler->__invoke($this->query);

        $this->assertEquals($this->hotel_id, $response->hotelId());
        $this->assertEquals($this->name, $response->hotelName());
        $this->assertEquals($this->address, $response->hotelAddress());
        $this->assertEquals($this->url, $response->hotelUrl());
        $this->assertEquals($this->available_rooms, $response->availableRooms());
        $this->assertSameSize($this->bookings_collection, $response->bookings());
    }

    private function createHotel(): Hotel
    {
        $id = new HotelId($this->hotel_id);
        $name = new HotelName($this->name);
        $address = new HotelAddress($this->address);
        $url = new HotelUrl($this->url);
        $available_rooms = new HotelAvailableRooms($this->available_rooms);
        $bookings_collection = new BookingsCollection($this->bookings_collection);

        return new Hotel($id, $name, $address, $url, $available_rooms, $bookings_collection);
    }
}
