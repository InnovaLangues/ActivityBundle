<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

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
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                instructionType INTEGER NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_DA7D23D581C06096 ON innova_instruction (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity (
                id INTEGER NOT NULL, 
                author_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                activitySequence_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
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
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_question (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_5C86412B81C06096 ON innova_question (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_proposition (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_660A01D081C06096 ON innova_proposition (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_information (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_88BEDA0081C06096 ON innova_information (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activityVf (
                id INTEGER NOT NULL, 
                user_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_263070EFA76ED395 ON innova_activityVf (user_id)
        ");
        $this->addSql("
            CREATE TABLE innova_object (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_3635428A81C06096 ON innova_object (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activitySequence (
                id INTEGER NOT NULL, 
                description CLOB DEFAULT NULL, 
                resourceNode_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_D614C342B87FAB32 ON innova_activitySequence (resourceNode_id)
        ");
    }

    public function down(Schema $schema)
    {
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