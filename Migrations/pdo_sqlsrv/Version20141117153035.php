<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlsrv;

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
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                title NVARCHAR(255), 
                instructionType INT NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_DA7D23D581C06096 ON innova_instruction (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity (
                id INT IDENTITY NOT NULL, 
                author_id INT, 
                name NVARCHAR(255) NOT NULL, 
                description VARCHAR(MAX), 
                activity_order INT NOT NULL, 
                createdDate DATETIME2(6) NOT NULL, 
                updatedDate DATETIME2(6) NOT NULL, 
                activitySequence_id INT, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013F28CE5809 ON innova_activity (activitySequence_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013FF675F31B ON innova_activity (author_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activityQru (
                id INT IDENTITY NOT NULL, 
                name NVARCHAR(255) NOT NULL, 
                description VARCHAR(MAX), 
                activity_order INT NOT NULL, 
                createdDate DATETIME2(6) NOT NULL, 
                updatedDate DATETIME2(6) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_question (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_5C86412B81C06096 ON innova_question (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_proposition (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_660A01D081C06096 ON innova_proposition (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_information (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_88BEDA0081C06096 ON innova_information (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activityVf (
                id INT IDENTITY NOT NULL, 
                user_id INT, 
                name NVARCHAR(255) NOT NULL, 
                description VARCHAR(MAX), 
                activity_order INT NOT NULL, 
                createdDate DATETIME2(6) NOT NULL, 
                updatedDate DATETIME2(6) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_263070EFA76ED395 ON innova_activityVf (user_id)
        ");
        $this->addSql("
            CREATE TABLE innova_object (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_3635428A81C06096 ON innova_object (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activitySequence (
                id INT IDENTITY NOT NULL, 
                description VARCHAR(MAX), 
                resourceNode_id INT, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_D614C342B87FAB32 ON innova_activitySequence (resourceNode_id) 
            WHERE resourceNode_id IS NOT NULL
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
            DROP CONSTRAINT FK_DA7D23D581C06096
        ");
        $this->addSql("
            ALTER TABLE innova_question 
            DROP CONSTRAINT FK_5C86412B81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_proposition 
            DROP CONSTRAINT FK_660A01D081C06096
        ");
        $this->addSql("
            ALTER TABLE innova_information 
            DROP CONSTRAINT FK_88BEDA0081C06096
        ");
        $this->addSql("
            ALTER TABLE innova_object 
            DROP CONSTRAINT FK_3635428A81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP CONSTRAINT FK_4605013F28CE5809
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