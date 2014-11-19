<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/11/19 03:06:45
 */
class Version20141119150643 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            DROP INDEX IDX_94C2979CF675F31B
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__AbstractActivity AS 
            SELECT id, 
            author_id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM AbstractActivity
        ");
        $this->addSql("
            DROP TABLE AbstractActivity
        ");
        $this->addSql("
            CREATE TABLE AbstractActivity (
                id INTEGER NOT NULL, 
                author_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                \"order\" INTEGER NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_94C2979CF675F31B FOREIGN KEY (author_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO AbstractActivity (
                id, author_id, name, description, \"order\", 
                createdDate, updatedDate
            ) 
            SELECT id, 
            author_id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM __temp__AbstractActivity
        ");
        $this->addSql("
            DROP TABLE __temp__AbstractActivity
        ");
        $this->addSql("
            CREATE INDEX IDX_94C2979CF675F31B ON AbstractActivity (author_id)
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activityQru AS 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM innova_activityQru
        ");
        $this->addSql("
            DROP TABLE innova_activityQru
        ");
        $this->addSql("
            CREATE TABLE innova_activityQru (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                \"order\" INTEGER NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_E91F6477BF396750 FOREIGN KEY (id) 
                REFERENCES innova_activitySequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activityQru (
                id, name, description, \"order\", createdDate, 
                updatedDate
            ) 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM __temp__innova_activityQru
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activityQru
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activityVf AS 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM innova_activityVf
        ");
        $this->addSql("
            DROP TABLE innova_activityVf
        ");
        $this->addSql("
            CREATE TABLE innova_activityVf (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                \"order\" INTEGER NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_263070EFBF396750 FOREIGN KEY (id) 
                REFERENCES innova_activitySequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activityVf (
                id, name, description, \"order\", createdDate, 
                updatedDate
            ) 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM __temp__innova_activityVf
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activityVf
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX IDX_94C2979CF675F31B
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__AbstractActivity AS 
            SELECT id, 
            author_id, 
            name, 
            description, 
            \"order\", 
            createdDate, 
            updatedDate 
            FROM AbstractActivity
        ");
        $this->addSql("
            DROP TABLE AbstractActivity
        ");
        $this->addSql("
            CREATE TABLE AbstractActivity (
                id INTEGER NOT NULL, 
                author_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                activity_order INTEGER NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_94C2979CF675F31B FOREIGN KEY (author_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO AbstractActivity (
                id, author_id, name, description, activity_order, 
                createdDate, updatedDate
            ) 
            SELECT id, 
            author_id, 
            name, 
            description, 
            \"order\", 
            createdDate, 
            updatedDate 
            FROM __temp__AbstractActivity
        ");
        $this->addSql("
            DROP TABLE __temp__AbstractActivity
        ");
        $this->addSql("
            CREATE INDEX IDX_94C2979CF675F31B ON AbstractActivity (author_id)
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activityQru AS 
            SELECT id, 
            name, 
            description, 
            \"order\", 
            createdDate, 
            updatedDate 
            FROM innova_activityQru
        ");
        $this->addSql("
            DROP TABLE innova_activityQru
        ");
        $this->addSql("
            CREATE TABLE innova_activityQru (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                activity_order INTEGER NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_E91F6477BF396750 FOREIGN KEY (id) 
                REFERENCES innova_activitySequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activityQru (
                id, name, description, activity_order, 
                createdDate, updatedDate
            ) 
            SELECT id, 
            name, 
            description, 
            \"order\", 
            createdDate, 
            updatedDate 
            FROM __temp__innova_activityQru
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activityQru
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activityVf AS 
            SELECT id, 
            name, 
            description, 
            \"order\", 
            createdDate, 
            updatedDate 
            FROM innova_activityVf
        ");
        $this->addSql("
            DROP TABLE innova_activityVf
        ");
        $this->addSql("
            CREATE TABLE innova_activityVf (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                activity_order INTEGER NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_263070EFBF396750 FOREIGN KEY (id) 
                REFERENCES innova_activitySequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activityVf (
                id, name, description, activity_order, 
                createdDate, updatedDate
            ) 
            SELECT id, 
            name, 
            description, 
            \"order\", 
            createdDate, 
            updatedDate 
            FROM __temp__innova_activityVf
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activityVf
        ");
    }
}