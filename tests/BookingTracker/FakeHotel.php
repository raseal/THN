<?php

declare(strict_types=1);

namespace Test\BookingTracker;

use BookingTracker\Domain\Booking\Booking;
use BookingTracker\Domain\Booking\BookingsCollection;
use BookingTracker\Domain\Hotel\Hotel;
use BookingTracker\Domain\Hotel\HotelAddress;
use BookingTracker\Domain\Hotel\HotelAvailableRooms;
use BookingTracker\Domain\Hotel\HotelId;
use BookingTracker\Domain\Hotel\HotelName;
use BookingTracker\Domain\Hotel\HotelUrl;

final class FakeHotel
{
    public static function create(): Hotel
    {
        $bookings = new BookingsCollection([]);
        $bookings->add(FakeBooking::create());

        return new Hotel(
            HotelId::random(),
            new HotelName('Overlook'),
            new HotelAddress('Rocky Mountains'),
            new HotelUrl('https://here-is-johnny.com'),
            new HotelAvailableRooms(6),
            $bookings
        );
    }

    public static function toArray(Hotel $hotel): array
    {
        $bookings_array = [];

        /** @var Booking $booking */
        foreach ($hotel->bookingsCollection() as $booking) {
            $bookings_array[] =[
                'bookingId' => $booking->BookingId()->value(),
                'room' => [
                    'hotelId' => $booking->room()->hotelId()->value(),
                    'roomId' => $booking->room()->roomId()->value(),
                    'roomType' => $booking->room()->roomType()->value(),
                ],
                'guest' => [
                    'guestId' => $booking->guest()->guestId()->value(),
                    'fullName' => $booking->guest()->fullName()->value(),
                    'email' => $booking->guest()->email()->value(),
                ],
                'from' => $booking->bookingInterval()->from()->format(FakeBooking::DATE_FORMAT),
                'to' => $booking->bookingInterval()->to()->format(FakeBooking::DATE_FORMAT),
            ];
        }

        return [
            'hotelId' => $hotel->hotelId()->value(),
            'hotelName' => $hotel->hotelName()->value(),
            'hotelAddress' => $hotel->hotelAddress()->value(),
            'hotelUrl' => $hotel->hotelUrl()->value(),
            'availableRooms' => $hotel->availableRooms()->value(),
            'bookings' => $bookings_array
        ];
    }
}
