<?php

namespace Innova\ActivityBundle\Migrations\drizzle_pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/11/17 03:30:37
 */
class Version20141117153035 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_instruction (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                instructionType INT NOT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_DA7D23D581C06096 (activity_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity (
                id INT AUTO_INCREMENT NOT NULL, 
                author_id INT DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                description TEXT DEFAULT NULL, 
                activity_order INT NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                activitySequence_id INT DEFAULT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_4605013F28CE5809 (activitySequence_id), 
                INDEX IDX_4605013FF675F31B (author_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activityQru (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description TEXT DEFAULT NULL, 
                activity_order INT NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_question (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_5C86412B81C06096 (activity_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_proposition (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_660A01D081C06096 (activity_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_information (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_88BEDA0081C06096 (activity_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activityVf (
                id INT AUTO_INCREMENT NOT NULL, 
                user_id INT DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                description TEXT DEFAULT NULL, 
                activity_order INT NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_263070EFA76ED395 (user_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_object (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_3635428A81C06096 (activity_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activitySequence (
                id INT AUTO_INCREMENT NOT NULL, 
                description TEXT DEFAULT NULL, 
                resourceNode_id INT DEFAULT NULL, 
                PRIMARY KEY(id), 
                UNIQUE INDEX UNIQ_D614C342B87FAB32 (resourceNode_id)
            )
        ");
        $this->addSql("
            ALTER TABLE innova_instruction 
            ADD CONSTRAINT FK_DA7D23D581C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD CONSTRAINT FK_4605013F28CE5809 FOREIGN KEY (activitySequence_id) 
            REFERENCES innova_activitySequence (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD CONSTRAINT FK_4605013FF675F31B FOREIGN KEY (author_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE innova_question 
            ADD CONSTRAINT FK_5C86412B81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_proposition 
            ADD CONSTRAINT FK_660A01D081C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_information 
            ADD CONSTRAINT FK_88BEDA0081C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityVf 
            ADD CONSTRAINT FK_263070EFA76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE innova_object 
            ADD CONSTRAINT FK_3635428A81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activitySequence 
            ADD CONSTRAINT FK_D614C342B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_instruction 
            DROP FOREIGN KEY FK_DA7D23D581C06096
        ");
        $this->addSql("
            ALTER TABLE innova_question 
            DROP FOREIGN KEY FK_5C86412B81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_proposition 
            DROP FOREIGN KEY FK_660A01D081C06096
        ");
        $this->addSql("
            ALTER TABLE innova_information 
            DROP FOREIGN KEY FK_88BEDA0081C06096
        ");
        $this->addSql("
            ALTER TABLE innova_object 
            DROP FOREIGN KEY FK_3635428A81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP FOREIGN KEY FK_4605013F28CE5809
        ");
        $this->addSql("
            DROP TABLE innova_instruction
        ");
        $this->addSql("
            DROP TABLE innova_activity
        ");
        $this->addSql("
            DROP TABLE innova_activityQru
        ");
        $this->addSql("
            DROP TABLE innova_question
        ");
        $this->addSql("
            DROP TABLE innova_proposition
        ");
        $this->addSql("
            DROP TABLE innova_information
        ");
        $this->addSql("
            DROP TABLE innova_activityVf
        ");
        $this->addSql("
            DROP TABLE innova_object
        ");
        $this->addSql("
            DROP TABLE innova_activitySequence
        ");
    }
}