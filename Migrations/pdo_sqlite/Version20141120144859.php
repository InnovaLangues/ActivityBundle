<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/11/20 02:49:00
 */
class Version20141120144859 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_sequence (
                id INTEGER NOT NULL, 
                description CLOB DEFAULT NULL, 
                resourceNode_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_CA5D5B00B87FAB32 ON innova_activity_sequence (resourceNode_id)
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_qru AS 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM innova_activity_qru
        ");
        $this->addSql("
            DROP TABLE innova_activity_qru
        ");
        $this->addSql("
            CREATE TABLE innova_activity_qru (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_913DCE68BF396750 FOREIGN KEY (id) 
                REFERENCES innova_activity_sequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_qru (
                id, name, description, activity_order, 
                createdDate, updatedDate
            ) 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM __temp__innova_activity_qru
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_qru
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_vf AS 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM innova_activity_vf
        ");
        $this->addSql("
            DROP TABLE innova_activity_vf
        ");
        $this->addSql("
            CREATE TABLE innova_activity_vf (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_353CDA7BF396750 FOREIGN KEY (id) 
                REFERENCES innova_activity_sequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_vf (
                id, name, description, activity_order, 
                createdDate, updatedDate
            ) 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM __temp__innova_activity_vf
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_vf
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE innova_activity_sequence
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_qru AS 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM innova_activity_qru
        ");
        $this->addSql("
            DROP TABLE innova_activity_qru
        ");
        $this->addSql("
            CREATE TABLE innova_activity_qru (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_913DCE68BF396750 FOREIGN KEY (id) 
                REFERENCES innova_activitySequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_qru (
                id, name, description, activity_order, 
                createdDate, updatedDate
            ) 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM __temp__innova_activity_qru
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_qru
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_vf AS 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM innova_activity_vf
        ");
        $this->addSql("
            DROP TABLE innova_activity_vf
        ");
        $this->addSql("
            CREATE TABLE innova_activity_vf (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_353CDA7BF396750 FOREIGN KEY (id) 
                REFERENCES innova_activitySequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_vf (
                id, name, description, activity_order, 
                createdDate, updatedDate
            ) 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM __temp__innova_activity_vf
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_vf
        ");
    }
}