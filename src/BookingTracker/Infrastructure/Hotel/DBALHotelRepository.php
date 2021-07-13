<?php

declare(strict_types=1);

namespace BookingTracker\Infrastructure\Hotel;

use BookingTracker\Domain\Booking\Booking;
use BookingTracker\Domain\Booking\BookingsCollection;
use BookingTracker\Domain\Booking\BookingId;
use BookingTracker\Domain\Booking\BookingInterval;
use BookingTracker\Domain\Guest\Guest;
use BookingTracker\Domain\Guest\GuestEmail;
use BookingTracker\Domain\Guest\GuestFullName;
use BookingTracker\Domain\Guest\GuestId;
use BookingTracker\Domain\Hotel\Hotel;
use BookingTracker\Domain\Hotel\HotelAddress;
use BookingTracker\Domain\Hotel\HotelAvailableRooms;
use BookingTracker\Domain\Hotel\HotelId;
use BookingTracker\Domain\Hotel\HotelName;
use BookingTracker\Domain\Hotel\HotelRepository;
use BookingTracker\Domain\Hotel\HotelsCollection;
use BookingTracker\Domain\Hotel\HotelUrl;
use BookingTracker\Domain\Hotel\Room\Room;
use BookingTracker\Domain\Hotel\Room\RoomId;
use BookingTracker\Domain\Hotel\Room\RoomType;
use Doctrine\DBAL\Driver\Connection;
use function current;

final class DBALHotelRepository implements HotelRepository
{
    public function __construct(
        private Connection $connection
    ) {}

    public function findById(HotelId $hotel_id): ?Hotel
    {
        $query = <<<SQL
SELECT
    BIN_TO_UUID(h.id) AS id_hotel,
    h.name,
    h.address,
    h.url,
    h.available_rooms,
    BIN_TO_UUID(r.id) AS id_room,
    rt.description AS room_type,
    BIN_TO_UUID(g.id) AS id_guest,
    g.fullname,
    g.email,
    BIN_TO_UUID(b.id) AS id_booking,
    b.booking_from,
    b.booking_to
FROM
    hotels AS h
    JOIN rooms AS r ON r.id_hotel = h.id
    JOIN room_type As rt ON rt.id = r.id_type
    LEFT JOIN bookings AS b ON b.id_room = r.id
    LEFT JOIN guests AS g ON g.id = b.id_guest
WHERE
    h.id = UUID_TO_BIN(:id)
SQL;
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue('id', $hotel_id->value());
        $stmt->execute();

        $data = $stmt->fetchAllAssociative();

        if (false === $data) {
            return null;
        }

        return $this->hydrateItem($data);
    }

    public function findAll(): HotelsCollection
    {
        $query = <<<SQL
SELECT
    BIN_TO_UUID(h.id) AS id_hotel,
    h.name,
    h.address,
    h.url,
    h.available_rooms,
    BIN_TO_UUID(r.id) AS id_room,
    rt.description AS room_type,
    BIN_TO_UUID(g.id) AS id_guest,
    g.fullname,
    g.email,
    BIN_TO_UUID(b.id) AS id_booking,
    b.booking_from,
    b.booking_to
FROM
    hotels AS h
    JOIN rooms AS r ON r.id_hotel = h.id
    JOIN room_type As rt ON rt.id = r.id_type
    LEFT JOIN bookings AS b ON b.id_room = r.id
    LEFT JOIN guests AS g ON g.id = b.id_guest
SQL;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        $data = $stmt->fetchAllAssociative();

        return $this->hydrateItems($data);
    }

    private function hydrateItem(array $data): Hotel
    {
        $current = current($data);
        $hotel_id = new HotelId($current['id_hotel']);
        $hotel_name = new HotelName($current['name']);
        $hotel_address = new HotelAddress($current['address']);
        $hotel_url = new HotelUrl($current['url']);
        $available_rooms = new HotelAvailableRooms((int)$current['available_rooms']);
        $booking_collection = new BookingsCollection([]);

        foreach($data as $row) {
            $room = new Room(
                new RoomId($row['id_room']),
                new HotelId($row['id_hotel']),
                new RoomType($row['room_type'])
            );

            $guest = new Guest(
                new GuestId($row['id_guest']),
                new GuestFullName($row['fullname']),
                new GuestEmail($row['email'])
            );

            $booking = new Booking(
                new BookingId($row['id_booking']),
                $room,
                $guest,
                BookingInterval::fromString($row['booking_from'], $row['booking_to'])
            );

            $booking_collection->add($booking);
        }

        return new Hotel($hotel_id, $hotel_name, $hotel_address, $hotel_url, $available_rooms, $booking_collection);
    }

    private function hydrateItems(array $items): HotelsCollection
    {
        $hotel_info = [];
        $data = [];

        foreach ($items as $item) {
            $hotel_info[$item['id_hotel']][] = $item;
        }

        foreach($hotel_info as $info) {
            $data[] = $this->hydrateItem($info);
        }

        return new HotelsCollection($data);
    }
}
