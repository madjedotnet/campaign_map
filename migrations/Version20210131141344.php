<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210131141344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tiles ADD building_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tiles ADD CONSTRAINT FK_1C1584BB4D2A7E12 FOREIGN KEY (building_id) REFERENCES buildings (id)');
        $this->addSql('CREATE INDEX IDX_1C1584BB4D2A7E12 ON tiles (building_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tiles DROP FOREIGN KEY FK_1C1584BB4D2A7E12');
        $this->addSql('DROP INDEX IDX_1C1584BB4D2A7E12 ON tiles');
        $this->addSql('ALTER TABLE tiles DROP building_id');
    }
}
