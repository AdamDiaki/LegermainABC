<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191205201134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf( $this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.' );

        $this->addSql( 'CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB' );
        $this->addSql( 'CREATE TABLE applicant (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_CAAD1019A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB' );
        $this->addSql( 'CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, applicant_id INT DEFAULT NULL, offer_id INT DEFAULT NULL, link_cv VARCHAR(255) NOT NULL, link_resume VARCHAR(255) NOT NULL, INDEX IDX_A45BDDC197139001 (applicant_id), INDEX IDX_A45BDDC153C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB' );
        $this->addSql( 'CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_23A0E6612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB' );
        $this->addSql( 'CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB' );
        $this->addSql( 'CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_81398E09A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB' );
        $this->addSql( 'CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, link VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C53D045F7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB' );
        $this->addSql( 'CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, offer_type_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, begin_at DATETIME NOT NULL, end_at DATETIME NOT NULL, created_at DATETIME NOT NULL, hourly_wage NUMERIC(4, 2) NOT NULL, address VARCHAR(255) NOT NULL, accepted TINYINT(1) NOT NULL, INDEX IDX_29D6873E64444A9A (offer_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB' );
        $this->addSql( 'CREATE TABLE offer_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB' );
        $this->addSql( 'CREATE TABLE request_project (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, contacted TINYINT(1) NOT NULL, INDEX IDX_597A2B99395C3F3 (customer_id), INDEX IDX_597A2B912469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB' );
        $this->addSql( 'CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB' );
        $this->addSql( 'ALTER TABLE applicant ADD CONSTRAINT FK_CAAD1019A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)' );
        $this->addSql( 'ALTER TABLE application ADD CONSTRAINT FK_A45BDDC197139001 FOREIGN KEY (applicant_id) REFERENCES applicant (id)' );
        $this->addSql( 'ALTER TABLE application ADD CONSTRAINT FK_A45BDDC153C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)' );
        $this->addSql( 'ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)' );
        $this->addSql( 'ALTER TABLE customer ADD CONSTRAINT FK_81398E09A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)' );
        $this->addSql( 'ALTER TABLE image ADD CONSTRAINT FK_C53D045F7294869C FOREIGN KEY (article_id) REFERENCES article (id)' );
        $this->addSql( 'ALTER TABLE offer ADD CONSTRAINT FK_29D6873E64444A9A FOREIGN KEY (offer_type_id) REFERENCES offer_type (id)' );
        $this->addSql( 'ALTER TABLE request_project ADD CONSTRAINT FK_597A2B99395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)' );
        $this->addSql( 'ALTER TABLE request_project ADD CONSTRAINT FK_597A2B912469DE2 FOREIGN KEY (category_id) REFERENCES category (id)' );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf( $this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.' );

        $this->addSql( 'ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC197139001' );
        $this->addSql( 'ALTER TABLE image DROP FOREIGN KEY FK_C53D045F7294869C' );
        $this->addSql( 'ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2' );
        $this->addSql( 'ALTER TABLE request_project DROP FOREIGN KEY FK_597A2B912469DE2' );
        $this->addSql( 'ALTER TABLE request_project DROP FOREIGN KEY FK_597A2B99395C3F3' );
        $this->addSql( 'ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC153C674EE' );
        $this->addSql( 'ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E64444A9A' );
        $this->addSql( 'ALTER TABLE applicant DROP FOREIGN KEY FK_CAAD1019A76ED395' );
        $this->addSql( 'ALTER TABLE customer DROP FOREIGN KEY FK_81398E09A76ED395' );
        $this->addSql( 'DROP TABLE admin' );
        $this->addSql( 'DROP TABLE applicant' );
        $this->addSql( 'DROP TABLE application' );
        $this->addSql( 'DROP TABLE article' );
        $this->addSql( 'DROP TABLE category' );
        $this->addSql( 'DROP TABLE customer' );
        $this->addSql( 'DROP TABLE image' );
        $this->addSql( 'DROP TABLE offer' );
        $this->addSql( 'DROP TABLE offer_type' );
        $this->addSql( 'DROP TABLE request_project' );
        $this->addSql( 'DROP TABLE user' );
    }
}
