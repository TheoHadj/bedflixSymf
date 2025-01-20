<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250115094302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA51BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_CEECCA51BCF5E72D ON films (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films DROP FOREIGN KEY FK_CEECCA51BCF5E72D');
        $this->addSql('DROP INDEX IDX_CEECCA51BCF5E72D ON films');
        $this->addSql('ALTER TABLE films DROP categorie_id');
    }
}
