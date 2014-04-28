<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140414164001 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, organizer_id INT NOT NULL, place_id INT NOT NULL, privacy_id INT NOT NULL, sport_id INT NOT NULL, title VARCHAR(255) NOT NULL, dateStart DATETIME NOT NULL, dateEnd DATETIME NOT NULL, memberLimit INT DEFAULT NULL, INDEX IDX_3BAE0AA7876C4DDA (organizer_id), INDEX IDX_3BAE0AA7DA6A219 (place_id), INDEX IDX_3BAE0AA719877A6A (privacy_id), INDEX IDX_3BAE0AA7AC78BCF8 (sport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE event_member (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, user_friend_id INT DEFAULT NULL, event_id INT NOT NULL, participation_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, INDEX IDX_427D8D2AA76ED395 (user_id), INDEX IDX_427D8D2A6AB4D50C (user_friend_id), INDEX IDX_427D8D2A71F7E88B (event_id), INDEX IDX_427D8D2A6ACE3B73 (participation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE event_member_participation (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE event_privacy (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE event_state (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, title VARCHAR(255) NOT NULL, imageFilename VARCHAR(255) DEFAULT NULL, INDEX IDX_741D53CD8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE regular_event (id INT AUTO_INCREMENT NOT NULL, organizer_id INT NOT NULL, place_id INT NOT NULL, privacy_id INT NOT NULL, sport_id INT NOT NULL, state_id INT NOT NULL, title VARCHAR(255) NOT NULL, dayStart VARCHAR(3) NOT NULL, timeStart VARCHAR(5) NOT NULL, dayEnd VARCHAR(3) NOT NULL, timeEnd VARCHAR(5) NOT NULL, memberLimit INT DEFAULT NULL, INDEX IDX_D1170D3D876C4DDA (organizer_id), INDEX IDX_D1170D3DDA6A219 (place_id), INDEX IDX_D1170D3D19877A6A (privacy_id), INDEX IDX_D1170D3DAC78BCF8 (sport_id), INDEX IDX_D1170D3D5D83CC1 (state_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, firstName VARCHAR(63) DEFAULT NULL, lastName VARCHAR(63) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), INDEX IDX_957A64798BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE user_friend (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_30BCB75CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7876C4DDA FOREIGN KEY (organizer_id) REFERENCES fos_user (id)");
        $this->addSql("ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)");
        $this->addSql("ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA719877A6A FOREIGN KEY (privacy_id) REFERENCES event_privacy (id)");
        $this->addSql("ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)");
        $this->addSql("ALTER TABLE event_member ADD CONSTRAINT FK_427D8D2AA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)");
        $this->addSql("ALTER TABLE event_member ADD CONSTRAINT FK_427D8D2A6AB4D50C FOREIGN KEY (user_friend_id) REFERENCES user_friend (id)");
        $this->addSql("ALTER TABLE event_member ADD CONSTRAINT FK_427D8D2A71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)");
        $this->addSql("ALTER TABLE event_member ADD CONSTRAINT FK_427D8D2A6ACE3B73 FOREIGN KEY (participation_id) REFERENCES event_member_participation (id)");
        $this->addSql("ALTER TABLE place ADD CONSTRAINT FK_741D53CD8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)");
        $this->addSql("ALTER TABLE regular_event ADD CONSTRAINT FK_D1170D3D876C4DDA FOREIGN KEY (organizer_id) REFERENCES fos_user (id)");
        $this->addSql("ALTER TABLE regular_event ADD CONSTRAINT FK_D1170D3DDA6A219 FOREIGN KEY (place_id) REFERENCES place (id)");
        $this->addSql("ALTER TABLE regular_event ADD CONSTRAINT FK_D1170D3D19877A6A FOREIGN KEY (privacy_id) REFERENCES event_privacy (id)");
        $this->addSql("ALTER TABLE regular_event ADD CONSTRAINT FK_D1170D3DAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)");
        $this->addSql("ALTER TABLE regular_event ADD CONSTRAINT FK_D1170D3D5D83CC1 FOREIGN KEY (state_id) REFERENCES event_state (id)");
        $this->addSql("ALTER TABLE fos_user ADD CONSTRAINT FK_957A64798BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)");
        $this->addSql("ALTER TABLE user_friend ADD CONSTRAINT FK_30BCB75CA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)");

        $this->addSql("INSERT INTO city (id, title) VALUES(1, 'donetsk')");

        $this->addSql("INSERT INTO event_member_participation (id, title) VALUES(1, 'yes')");
        $this->addSql("INSERT INTO event_member_participation (id, title) VALUES(2, 'no')");
        $this->addSql("INSERT INTO event_member_participation (id, title) VALUES(3, 'wish')");

        $this->addSql("INSERT INTO event_state (id, title) VALUES(1, 'active')");
        $this->addSql("INSERT INTO event_state (id, title) VALUES(2, 'finished')");

        $this->addSql("INSERT INTO event_privacy (id, title) VALUES(1, 'public')");
        $this->addSql("INSERT INTO event_privacy (id, title) VALUES(2, 'private')");

        $this->addSql("INSERT INTO sport (id, title) VALUES(1, 'football')");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE place DROP FOREIGN KEY FK_741D53CD8BAC62AF");
        $this->addSql("ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64798BAC62AF");
        $this->addSql("ALTER TABLE event_member DROP FOREIGN KEY FK_427D8D2A71F7E88B");
        $this->addSql("ALTER TABLE event_member DROP FOREIGN KEY FK_427D8D2A6ACE3B73");
        $this->addSql("ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA719877A6A");
        $this->addSql("ALTER TABLE regular_event DROP FOREIGN KEY FK_D1170D3D19877A6A");
        $this->addSql("ALTER TABLE regular_event DROP FOREIGN KEY FK_D1170D3D5D83CC1");
        $this->addSql("ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7DA6A219");
        $this->addSql("ALTER TABLE regular_event DROP FOREIGN KEY FK_D1170D3DDA6A219");
        $this->addSql("ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7AC78BCF8");
        $this->addSql("ALTER TABLE regular_event DROP FOREIGN KEY FK_D1170D3DAC78BCF8");
        $this->addSql("ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7876C4DDA");
        $this->addSql("ALTER TABLE event_member DROP FOREIGN KEY FK_427D8D2AA76ED395");
        $this->addSql("ALTER TABLE regular_event DROP FOREIGN KEY FK_D1170D3D876C4DDA");
        $this->addSql("ALTER TABLE user_friend DROP FOREIGN KEY FK_30BCB75CA76ED395");
        $this->addSql("ALTER TABLE event_member DROP FOREIGN KEY FK_427D8D2A6AB4D50C");
        $this->addSql("DROP TABLE city");
        $this->addSql("DROP TABLE event");
        $this->addSql("DROP TABLE event_member");
        $this->addSql("DROP TABLE event_member_participation");
        $this->addSql("DROP TABLE event_privacy");
        $this->addSql("DROP TABLE event_state");
        $this->addSql("DROP TABLE place");
        $this->addSql("DROP TABLE regular_event");
        $this->addSql("DROP TABLE sport");
        $this->addSql("DROP TABLE fos_user");
        $this->addSql("DROP TABLE user_friend");
    }
}
