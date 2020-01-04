<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200104172507 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article CHANGE category_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE application CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE actuality CHANGE image_id image_id INT NOT NULL');
        $this->addSql('ALTER TABLE background_image CHANGE category_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE image CHANGE accueil accueil TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE offer CHANGE offer_type_id offer_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE request_project CHANGE category_id category_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE actuality CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE application CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article CHANGE category_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE background_image CHANGE category_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE accueil accueil TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE offer CHANGE offer_type_id offer_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE request_project CHANGE category_id category_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
    }
}
