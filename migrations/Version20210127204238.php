<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127204238 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE armies (id INT AUTO_INCREMENT NOT NULL, warhammer_army_id INT NOT NULL, user_id INT NOT NULL, map_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, INDEX IDX_AEB4AEE615457EED (warhammer_army_id), INDEX IDX_AEB4AEE6A76ED395 (user_id), INDEX IDX_AEB4AEE653C55F64 (map_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE armies ADD CONSTRAINT FK_AEB4AEE615457EED FOREIGN KEY (warhammer_army_id) REFERENCES warhammer_armies (id)');
        $this->addSql('ALTER TABLE armies ADD CONSTRAINT FK_AEB4AEE6A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE armies ADD CONSTRAINT FK_AEB4AEE653C55F64 FOREIGN KEY (map_id) REFERENCES maps (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE armies');
    }
}
