<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191216090755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC197139001');
        $this->addSql('ALTER TABLE request_project DROP FOREIGN KEY FK_597A2B99395C3F3');
        $this->addSql('CREATE TABLE accueil_image (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_310A55CE3DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actuality (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_4093DDD83DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE background_image (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, INDEX IDX_941A967812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accueil_image ADD CONSTRAINT FK_310A55CE3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE actuality ADD CONSTRAINT FK_4093DDD83DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE background_image ADD CONSTRAINT FK_941A967812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE applicant');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP INDEX IDX_A45BDDC197139001 ON application');
        $this->addSql('ALTER TABLE application CHANGE applicant_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A45BDDC1A76ED395 ON application (user_id)');
        $this->addSql('ALTER TABLE article ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E663DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_23A0E663DA5256D ON article (image_id)');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F7294869C');
        $this->addSql('DROP INDEX IDX_C53D045F7294869C ON image');
        $this->addSql('ALTER TABLE image DROP main_image, CHANGE article_id background_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FE6DA28AA FOREIGN KEY (background_image_id) REFERENCES background_image (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FE6DA28AA ON image (background_image_id)');
        $this->addSql('DROP INDEX IDX_597A2B99395C3F3 ON request_project');
        $this->addSql('ALTER TABLE request_project CHANGE customer_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE request_project ADD CONSTRAINT FK_597A2B9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_597A2B9A76ED395 ON request_project (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FE6DA28AA');
        $this->addSql('CREATE TABLE applicant (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_CAAD1019A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_81398E09A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE applicant ADD CONSTRAINT FK_CAAD1019A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE accueil_image');
        $this->addSql('DROP TABLE actuality');
        $this->addSql('DROP TABLE background_image');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1A76ED395');
        $this->addSql('DROP INDEX IDX_A45BDDC1A76ED395 ON application');
        $this->addSql('ALTER TABLE application CHANGE user_id applicant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC197139001 FOREIGN KEY (applicant_id) REFERENCES applicant (id)');
        $this->addSql('CREATE INDEX IDX_A45BDDC197139001 ON application (applicant_id)');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E663DA5256D');
        $this->addSql('DROP INDEX IDX_23A0E663DA5256D ON article');
        $this->addSql('ALTER TABLE article DROP image_id');
        $this->addSql('DROP INDEX IDX_C53D045FE6DA28AA ON image');
        $this->addSql('ALTER TABLE image ADD main_image TINYINT(1) NOT NULL, CHANGE background_image_id article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F7294869C ON image (article_id)');
        $this->addSql('ALTER TABLE request_project DROP FOREIGN KEY FK_597A2B9A76ED395');
        $this->addSql('DROP INDEX IDX_597A2B9A76ED395 ON request_project');
        $this->addSql('ALTER TABLE request_project CHANGE user_id customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE request_project ADD CONSTRAINT FK_597A2B99395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_597A2B99395C3F3 ON request_project (customer_id)');
    }
}
