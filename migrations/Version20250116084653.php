<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116084653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE series ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE series ADD CONSTRAINT FK_3A10012DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_3A10012DBCF5E72D ON series (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE series DROP FOREIGN KEY FK_3A10012DBCF5E72D');
        $this->addSql('DROP INDEX IDX_3A10012DBCF5E72D ON series');
        $this->addSql('ALTER TABLE series DROP categorie_id');
    }
}
