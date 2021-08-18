<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210816121254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plats_panier ADD panier_id INT NOT NULL, ADD quantitã© INT NOT NULL, ADD price DOUBLE PRECISION NOT NULL, CHANGE quantit plats_id INT NOT NULL');
        $this->addSql('ALTER TABLE plats_panier ADD CONSTRAINT FK_F4771D8FAA14E1C8 FOREIGN KEY (plats_id) REFERENCES plats_panier (id)');
        $this->addSql('ALTER TABLE plats_panier ADD CONSTRAINT FK_F4771D8FF77D927C FOREIGN KEY (panier_id) REFERENCES plats_panier (id)');
        $this->addSql('CREATE INDEX IDX_F4771D8FAA14E1C8 ON plats_panier (plats_id)');
        $this->addSql('CREATE INDEX IDX_F4771D8FF77D927C ON plats_panier (panier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plats_panier DROP FOREIGN KEY FK_F4771D8FAA14E1C8');
        $this->addSql('ALTER TABLE plats_panier DROP FOREIGN KEY FK_F4771D8FF77D927C');
        $this->addSql('DROP INDEX IDX_F4771D8FAA14E1C8 ON plats_panier');
        $this->addSql('DROP INDEX IDX_F4771D8FF77D927C ON plats_panier');
        $this->addSql('ALTER TABLE plats_panier ADD quantit INT NOT NULL, DROP plats_id, DROP panier_id, DROP quantitã©, DROP price');
    }
}
