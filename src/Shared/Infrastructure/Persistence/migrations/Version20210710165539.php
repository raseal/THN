<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210710165539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create empty tables';
    }

    public function up(Schema $schema): void
    {
        // Table "hotels"
        $this->addSql("CREATE TABLE hotels(
            id BINARY(16) NOT NULL,
            name VARCHAR (200) NOT NULL,
            address VARCHAR (200) NOT NULL,
            url VARCHAR (100) NOT NULL,
            available_rooms SMALLINT NOT NULL,
            PRIMARY KEY(id)
        )
        DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`
        ENGINE = InnoDB");

        // Table "rooms"
        $this->addSql("CREATE TABLE rooms(
            id BINARY(16) NOT NULL,
            id_hotel BINARY(16) NOT NULL,
            id_type BINARY(16) NOT NULL,
            PRIMARY KEY(id)
        )
        DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`
        ENGINE = InnoDB");

        // Table "room_type"
        $this->addSql("CREATE TABLE room_type(
            id BINARY(16) NOT NULL,
            description VARCHAR(100) NOT NULL,
            PRIMARY KEY(id)
        )
        DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`
        ENGINE = InnoDB");

        // Table "guests"
        $this->addSql("CREATE TABLE guests(
            id BINARY(16) NOT NULL,
            fullname VARCHAR(200) NOT NULL,
            email VARCHAR(200) NOT NULL,
            PRIMARY KEY(id)
        )
        DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`
        ENGINE = InnoDB");

        // Table "bookings"
        $this->addSql("CREATE TABLE bookings(
            id BINARY(16) NOT NULL,
            id_room BINARY(16) NOT NULL,
            id_guest BINARY(16) NOT NULL,
            booking_from DATETIME NOT NULL,
            booking_to DATETIME NOT NULL,
            PRIMARY KEY(id)
        )
        DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`
        ENGINE = InnoDB");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE hotels");
        $this->addSql("DROP TABLE rooms");
        $this->addSql("DROP TABLE room_type");
        $this->addSql("DROP TABLE guests");
        $this->addSql("DROP TABLE bookings");
    }
}
