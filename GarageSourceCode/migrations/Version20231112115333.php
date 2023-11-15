<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231112115333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(

            'CREATE TABLE annonce (
                id INT AUTO_INCREMENT NOT NULL, 
                brand VARCHAR(20) NOT NULL, 
                model VARCHAR(30) NOT NULL, 
                description LONGTEXT DEFAULT NULL, 
                year INT NOT NULL, 
                mileage INT NOT NULL, 
                fuel_type VARCHAR(20) NOT NULL, 
                transmission VARCHAR(20) NOT NULL, 
                price VARCHAR(255) NOT NULL, 
                img_path1 VARCHAR(255) DEFAULT NULL, 
                img_path2 VARCHAR(255) DEFAULT NULL, 
                img_path3 VARCHAR(255) DEFAULT NULL, 
                img_path4 VARCHAR(255) DEFAULT NULL, 
                img_path5 VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)) 
                DEFAULT CHARACTER SET utf8mb4 
                COLLATE `utf8mb4_unicode_ci` 
                ENGINE = InnoDB'
            );

        $this->addSql(

            'CREATE TABLE contact_info (
                id INT AUTO_INCREMENT NOT NULL, 
                phone_number VARCHAR(80) DEFAULT NULL, 
                e_mail VARCHAR(80) DEFAULT NULL, 
                PRIMARY KEY(id)) 
                DEFAULT CHARACTER SET utf8mb4 
                COLLATE `utf8mb4_unicode_ci` 
                ENGINE = InnoDB'
            );

        $this->addSql(

            'CREATE TABLE contact_requests (
                id INT AUTO_INCREMENT NOT NULL, 
                user_first_name VARCHAR(255) DEFAULT NULL, 
                user_last_name VARCHAR(255) DEFAULT NULL, 
                user_e_mail VARCHAR(255) NOT NULL, 
                user_phone_number VARCHAR(255) DEFAULT NULL, 
                subject VARCHAR(255) DEFAULT NULL, 
                user_message VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)) 
                DEFAULT CHARACTER SET utf8mb4 
                COLLATE `utf8mb4_unicode_ci` 
                ENGINE = InnoDB'
            );

        $this->addSql(

            'CREATE TABLE reviews (
                id INT AUTO_INCREMENT NOT NULL, 
                user_mail_id INT DEFAULT NULL, 
                grade INT NOT NULL, 
                review VARCHAR(100) DEFAULT NULL, 
                was_moderated TINYINT(1) NOT NULL, 
                UNIQUE INDEX UNIQ_6970EB0F907A710B (user_mail_id), 
                PRIMARY KEY(id)) 
                DEFAULT CHARACTER SET utf8mb4 
                COLLATE `utf8mb4_unicode_ci` 
                ENGINE = InnoDB'
            );

        $this->addSql(

            'CREATE TABLE services (
                id INT AUTO_INCREMENT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                description VARCHAR(255) DEFAULT NULL, 
                price INT DEFAULT NULL, 
                img_path VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)) 
                DEFAULT CHARACTER SET utf8mb4 
                COLLATE `utf8mb4_unicode_ci` 
                ENGINE = InnoDB'
            );

        $this->addSql(

            'CREATE TABLE user (
                id INT AUTO_INCREMENT NOT NULL, 
                email VARCHAR(180) NOT NULL, 
                roles JSON NOT NULL COMMENT \'(DC2Type:json)\', 
                password VARCHAR(255) NOT NULL, 
                is_verified TINYINT(1) NOT NULL, 
                UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), 
                PRIMARY KEY(id)) 
                DEFAULT CHARACTER SET utf8mb4 
                COLLATE `utf8mb4_unicode_ci` 
                ENGINE = InnoDB'
            );

        $this->addSql(

            'CREATE TABLE working_hours (
                id INT AUTO_INCREMENT NOT NULL, 
                monday VARCHAR(30) DEFAULT NULL, 
                tuesday VARCHAR(30) DEFAULT NULL, 
                wednesday VARCHAR(30) DEFAULT NULL, 
                thursday VARCHAR(30) DEFAULT NULL, 
                friday VARCHAR(30) DEFAULT NULL, 
                saturday VARCHAR(30) DEFAULT NULL, 
                sunday VARCHAR(30) DEFAULT NULL, 
                PRIMARY KEY(id)) 
                DEFAULT CHARACTER SET utf8mb4 
                COLLATE `utf8mb4_unicode_ci` 
                ENGINE = InnoDB'
            );

        $this->addSql(

            'ALTER TABLE reviews 
            ADD CONSTRAINT FK_6970EB0F907A710B 
            FOREIGN KEY (user_mail_id) REFERENCES user (id) ON DELETE SET NULL'
        );
        
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0F907A710B');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE contact_info');
        $this->addSql('DROP TABLE contact_requests');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE working_hours');
    }
}
