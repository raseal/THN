<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210711145453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create the table relations';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE `rooms` ADD FOREIGN KEY (`id_type`) REFERENCES `room_type`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION");
        $this->addSql("ALTER TABLE `rooms` ADD FOREIGN KEY (`id_hotel`) REFERENCES `hotels`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION");
        $this->addSql("ALTER TABLE `bookings` ADD FOREIGN KEY (`id_guest`) REFERENCES `guests`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION");
        $this->addSql("ALTER TABLE `bookings` ADD FOREIGN KEY (`id_room`) REFERENCES `rooms`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION");
    }
}
