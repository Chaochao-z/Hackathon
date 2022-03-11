<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220310142849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report DROP CONSTRAINT fk_c42f77849d86650f');
        $this->addSql('DROP INDEX idx_c42f77849d86650f');
        $this->addSql('ALTER TABLE report RENAME COLUMN user_id_id TO user_id');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C42F7784A76ED395 ON report (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE report DROP CONSTRAINT FK_C42F7784A76ED395');
        $this->addSql('DROP INDEX IDX_C42F7784A76ED395');
        $this->addSql('ALTER TABLE report RENAME COLUMN user_id TO user_id_id');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT fk_c42f77849d86650f FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c42f77849d86650f ON report (user_id_id)');
    }
}
