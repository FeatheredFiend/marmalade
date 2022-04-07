<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220406133359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abi_code_rating MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE abi_code_rating DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE abi_code_rating DROP id');
        $this->addSql('ALTER TABLE abi_code_rating ADD PRIMARY KEY (abi_code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abi_code_rating ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
