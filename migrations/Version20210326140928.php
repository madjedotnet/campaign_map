<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326140928 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tiles ADD scenery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tiles ADD CONSTRAINT FK_1C1584BB8C84AC99 FOREIGN KEY (scenery_id) REFERENCES warhammer_sceneries (id)');
        $this->addSql('CREATE INDEX IDX_1C1584BB8C84AC99 ON tiles (scenery_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tiles DROP FOREIGN KEY FK_1C1584BB8C84AC99');
        $this->addSql('DROP INDEX IDX_1C1584BB8C84AC99 ON tiles');
        $this->addSql('ALTER TABLE tiles DROP scenery_id');
    }
}
