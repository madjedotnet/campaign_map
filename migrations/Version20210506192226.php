<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210506192226 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maps ADD map_status_id INT NOT NULL');
        $this->addSql('ALTER TABLE maps ADD CONSTRAINT FK_472E08A5CE9F47E0 FOREIGN KEY (map_status_id) REFERENCES maps_status (id)');
        $this->addSql('CREATE INDEX IDX_472E08A5CE9F47E0 ON maps (map_status_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maps DROP FOREIGN KEY FK_472E08A5CE9F47E0');
        $this->addSql('DROP INDEX IDX_472E08A5CE9F47E0 ON maps');
        $this->addSql('ALTER TABLE maps DROP map_status_id');
    }
}
