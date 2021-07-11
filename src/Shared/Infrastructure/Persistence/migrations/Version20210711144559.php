<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210711144559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Populate all tables';
    }

    public function up(Schema $schema): void
    {
        // Table "hotels"
        $this->addSql("INSERT INTO hotels(id, name, address, url, available_rooms) VALUES
            (UUID_TO_BIN('615cf276-f66c-4c6b-9c68-ba6f438f4c78'), 'Overlook', 'Rocky Mountains, Colorado', 'https://here-is-johhny.com', 666),
            (UUID_TO_BIN('88694bad-7660-4c79-9ea4-0cf80ef9f621'), 'Bates Motel', 'Fairvale, California', 'https://fear-the-shower.net', 15)");

        // Table "guests"
        $this->addSql("INSERT INTO guests(id, fullname, email) VALUES
            (UUID_TO_BIN('0a1d0dbe-024e-423e-937d-c8893570e543'),'Jack Torrance','jack.torrance@overlook.com'),
            (UUID_TO_BIN('ee149846-b69a-416e-a510-cc6b51425ce2'),'Danny Torrance','danny.torrance@redrum.com'),
            (UUID_TO_BIN('93db187a-40ac-4857-bfc9-cdaea6b62c32'),'Wendy Torrance','wendy.torrance@bigaxe.com'),
            (UUID_TO_BIN('5b71d1d9-6fb4-4e94-8055-f352e12fbdbb'),'Norman Bates','norman.bates@motelbates.com'),
            (UUID_TO_BIN('0f8aa5a5-8c6b-45ca-92ca-05d8866c5a79'),'Marion Crane','marion.crane@showerareevil.com'),
            (UUID_TO_BIN('84facdd5-ae17-4414-b4eb-8e1ccf451e34'),'Sam Loomis','sam.loomis@needanotherjob.com')");

        // Table "room_type"
        $this->addSql("INSERT INTO room_type(id,description) VALUES
            (UUID_TO_BIN('57e7db26-d352-45d9-85ee-09285dd7ab5c'),'single'),
            (UUID_TO_BIN('51aced01-07a4-4772-8c1b-5dfd5b80eff1'),'double'),
            (UUID_TO_BIN('24d5117e-b6a4-4b07-899f-c4431a230553'),'suite')");

        // Table "rooms"
        $this->addSql("INSERT INTO rooms(id,id_hotel,id_type) VALUES
            (UUID_TO_BIN('87461796-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('615cf276-f66c-4c6b-9c68-ba6f438f4c78'),UUID_TO_BIN('57e7db26-d352-45d9-85ee-09285dd7ab5c')),
            (UUID_TO_BIN('87461a20-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('615cf276-f66c-4c6b-9c68-ba6f438f4c78'),UUID_TO_BIN('51aced01-07a4-4772-8c1b-5dfd5b80eff1')),
            (UUID_TO_BIN('87461cfa-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('615cf276-f66c-4c6b-9c68-ba6f438f4c78'),UUID_TO_BIN('24d5117e-b6a4-4b07-899f-c4431a230553')),
            (UUID_TO_BIN('87461dc2-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('88694bad-7660-4c79-9ea4-0cf80ef9f621'),UUID_TO_BIN('57e7db26-d352-45d9-85ee-09285dd7ab5c')),
            (UUID_TO_BIN('87461e80-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('88694bad-7660-4c79-9ea4-0cf80ef9f621'),UUID_TO_BIN('51aced01-07a4-4772-8c1b-5dfd5b80eff1')),
            (UUID_TO_BIN('87461f34-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('88694bad-7660-4c79-9ea4-0cf80ef9f621'),UUID_TO_BIN('24d5117e-b6a4-4b07-899f-c4431a230553'))");

        // Table "bookings"
        $this->addSql("INSERT INTO bookings(id,id_room,id_guest,booking_from,booking_to) VALUES
            (UUID_TO_BIN('d6a9b847-e309-44c9-a8ff-939a7c63bf04'),UUID_TO_BIN('87461796-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('0a1d0dbe-024e-423e-937d-c8893570e543'),'2020-10-01','2020-10-08'),
            (UUID_TO_BIN('5b292cd6-be72-448d-86d2-fd3b51ed2a15'),UUID_TO_BIN('87461a20-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('0a1d0dbe-024e-423e-937d-c8893570e543'),'2021-10-01','2021-10-04'),
            (UUID_TO_BIN('3f3bb058-84f9-4866-961b-3430ffdf5ada'),UUID_TO_BIN('87461a20-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('93db187a-40ac-4857-bfc9-cdaea6b62c32'),'1997-03-14','1997-03-15'),
            (UUID_TO_BIN('99b82276-1a6d-41cb-a9a7-404258af7ce2'),UUID_TO_BIN('87461a20-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('93db187a-40ac-4857-bfc9-cdaea6b62c32'),'1999-02-14','1999-02-15'),
            (UUID_TO_BIN('5a9f8f56-3e3e-4bab-9ce4-5f3f234a7996'),UUID_TO_BIN('87461a20-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('93db187a-40ac-4857-bfc9-cdaea6b62c32'),'2003-07-24','2003-08-07'),
            (UUID_TO_BIN('65e1d754-d4ba-44d3-b069-9d25eb220370'),UUID_TO_BIN('87461cfa-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('ee149846-b69a-416e-a510-cc6b51425ce2'),'2019-12-30','2020-01-07'),
            (UUID_TO_BIN('9a4a387f-c499-4067-9a66-d544499ebe62'),UUID_TO_BIN('87461dc2-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('5b71d1d9-6fb4-4e94-8055-f352e12fbdbb'),'1984-02-29','1984-03-03'),
            (UUID_TO_BIN('3834ffda-f4cf-4f9f-ade6-6ca8e97ffca9'),UUID_TO_BIN('87461dc2-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('5b71d1d9-6fb4-4e94-8055-f352e12fbdbb'),'1988-02-02','1988-02-06'),
            (UUID_TO_BIN('b4855934-2560-4319-8ca9-b3d348a5ab47'),UUID_TO_BIN('87461dc2-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('5b71d1d9-6fb4-4e94-8055-f352e12fbdbb'),'1982-03-03','1982-03-30'),
            (UUID_TO_BIN('16929b29-cc69-4484-91cc-0d07b9bb6127'),UUID_TO_BIN('87461f34-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('0f8aa5a5-8c6b-45ca-92ca-05d8866c5a79'),'1983-04-23','1983-05-14'),
            (UUID_TO_BIN('882a02b5-9c01-462e-a2d3-e4795f2105b8'),UUID_TO_BIN('87461e80-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('84facdd5-ae17-4414-b4eb-8e1ccf451e34'),'1985-07-02','1985-07-07'),
            (UUID_TO_BIN('86fd1a8f-e84b-47c8-868e-de9392ff01ad'),UUID_TO_BIN('87461f34-e250-11eb-ba80-0242ac130004'),UUID_TO_BIN('84facdd5-ae17-4414-b4eb-8e1ccf451e34'),'1986-12-31','1987-01-03')");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("TRUNCATE TABLE hotels");
        $this->addSql("TRUNCATE TABLE guests");
        $this->addSql("TRUNCATE TABLE room_type");
        $this->addSql("TRUNCATE TABLE rooms");
        $this->addSql("TRUNCATE TABLE bookings");
    }
}
