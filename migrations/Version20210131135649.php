<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210131135649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tiles (id INT AUTO_INCREMENT NOT NULL, scenery_id INT DEFAULT NULL, map_id INT NOT NULL, coordinates VARCHAR(10) DEFAULT NULL, INDEX IDX_1C1584BB8C84AC99 (scenery_id), INDEX IDX_1C1584BB53C55F64 (map_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE warhammer_sceneries (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tiles ADD CONSTRAINT FK_1C1584BB8C84AC99 FOREIGN KEY (scenery_id) REFERENCES warhammer_sceneries (id)');
        $this->addSql('ALTER TABLE tiles ADD CONSTRAINT FK_1C1584BB53C55F64 FOREIGN KEY (map_id) REFERENCES maps (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tiles DROP FOREIGN KEY FK_1C1584BB8C84AC99');
        $this->addSql('DROP TABLE tiles');
        $this->addSql('DROP TABLE warhammer_sceneries');
    }
}
