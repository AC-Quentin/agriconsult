<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240911095331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_commerciale ADD commentaire LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE manutention ADD commentaire LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE nettoyeur ADD commentaire LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE secheuse ADD commentaire LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE sechoir ADD commentaire LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE stockage ADD commentaire LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_commerciale DROP commentaire');
        $this->addSql('ALTER TABLE manutention DROP commentaire');
        $this->addSql('ALTER TABLE nettoyeur DROP commentaire');
        $this->addSql('ALTER TABLE secheuse DROP commentaire');
        $this->addSql('ALTER TABLE sechoir DROP commentaire');
        $this->addSql('ALTER TABLE stockage DROP commentaire');
    }
}
