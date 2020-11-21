<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201120221249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, utilisateur_id VARCHAR(255) NOT NULL, utilisateur_firstname VARCHAR(255) NOT NULL, utilisateur_lastname VARCHAR(255) NOT NULL, utilisateur_gender VARCHAR(255) NOT NULL, utilisateur_phone VARCHAR(255) NOT NULL, utilisateur_mail VARCHAR(255) NOT NULL, utilisateur_city VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_497B315E828ACF03 (utilisateur_phone), UNIQUE INDEX UNIQ_497B315E98A7C072 (utilisateur_mail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE utilisateurs');
    }
}
