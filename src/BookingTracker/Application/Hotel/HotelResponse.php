<?php

declare(strict_types=1);

namespace BookingTracker\Application\Hotel;

use BookingTracker\Domain\Booking\Booking;
use BookingTracker\Domain\Hotel\Hotel;
use JsonSerializable;
use Shared\Domain\Bus\Query\Response;

final class HotelResponse implements Response, JsonSerializable
{
    public function __construct(
        private string $hotel_id,
        private string $hotel_name,
        private string $hotel_address,
        private string $hotel_url,
        private int $available_rooms,
        private array $bookings
    ) {}

    public static function fromHotel(Hotel $hotel): self
    {
        return new self(
            $hotel->hotelId()->value(),
            $hotel->hotelName()->value(),
            $hotel->hotelAddress()->value(),
            $hotel->hotelUrl()->value(),
            $hotel->availableRooms()->value(),
            $hotel->bookingsCollection()->items()
        );
    }

    public function jsonSerialize(): array
    {
        $bookings = [];

        /** @var Booking $booking */
        foreach ($this->bookings as $booking) {
            $bookings[] = [
                'bookingId' => $booking->bookingId()->value(),
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
                'from' => $booking->bookingInterval()->from()->format('Y-m-d'),
                'to' => $booking->bookingInterval()->to()->format('Y-m-d'),
            ];
        }

        return [
            'hotelId' => $this->hotelId(),
            'hotelName' => $this->hotelName(),
            'hotelAddress' => $this->hotelAddress(),
            'hotelUrl' => $this->hotelUrl(),
            'availableRooms' => $this->availableRooms(),
            'bookings' => $bookings,
        ];
    }

    public function hotelId(): string
    {
        return $this->hotel_id;
    }

    public function hotelName(): string
    {
        return $this->hotel_name;
    }

    public function hotelAddress(): string
    {
        return $this->hotel_address;
    }

    public function hotelUrl(): string
    {
        return $this->hotel_url;
    }

    public function availableRooms(): int
    {
        return $this->available_rooms;
    }

    public function bookings(): array
    {
        return $this->bookings;
    }
}
