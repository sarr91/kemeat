<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819121330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_detail (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, nos_plats_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_2C52844682EA2E54 (commande_id), INDEX IDX_2C528446639951A (nos_plats_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_detail ADD CONSTRAINT FK_2C52844682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande_detail ADD CONSTRAINT FK_2C528446639951A FOREIGN KEY (nos_plats_id) REFERENCES nos_plats (id)');
        $this->addSql('ALTER TABLE plats_panier CHANGE quantit quantit� INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_detail');
        $this->addSql('ALTER TABLE plats_panier CHANGE quantit� quantit INT NOT NULL');
    }
}
