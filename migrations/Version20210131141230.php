<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210131141230 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE buildings (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tiles ADD army_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tiles ADD CONSTRAINT FK_1C1584BB18D2742D FOREIGN KEY (army_id) REFERENCES armies (id)');
        $this->addSql('CREATE INDEX IDX_1C1584BB18D2742D ON tiles (army_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE buildings');
        $this->addSql('ALTER TABLE tiles DROP FOREIGN KEY FK_1C1584BB18D2742D');
        $this->addSql('DROP INDEX IDX_1C1584BB18D2742D ON tiles');
        $this->addSql('ALTER TABLE tiles DROP army_id');
    }
}
