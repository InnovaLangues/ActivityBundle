<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/12/03 11:15:51
 */
class Version20141203111550 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_type_available_activity (
                activity_id INTEGER NOT NULL, 
                type_id INTEGER NOT NULL, 
                PRIMARY KEY(activity_id, type_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_BD23E5281C06096 ON innova_activity_type_available_activity (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_BD23E52C54C8C93 ON innova_activity_type_available_activity (type_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_available (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                class VARCHAR(100) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DROP INDEX IDX_4605013F967573A2
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity AS 
            SELECT id, 
            activity_sequence_id, 
            name, 
            description, 
            activity_position, 
            date_created, 
            date_updated 
            FROM innova_activity
        ");
        $this->addSql("
            DROP TABLE innova_activity
        ");
        $this->addSql("
            CREATE TABLE innova_activity (
                id INTEGER NOT NULL, 
                activity_sequence_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_position INTEGER NOT NULL, 
                date_created DATETIME NOT NULL, 
                date_updated DATETIME NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_4605013F967573A2 FOREIGN KEY (activity_sequence_id) 
                REFERENCES innova_activity_sequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity (
                id, activity_sequence_id, name, description, 
                activity_position, date_created, 
                date_updated
            ) 
            SELECT id, 
            activity_sequence_id, 
            name, 
            description, 
            activity_position, 
            date_created, 
            date_updated 
            FROM __temp__innova_activity
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013F967573A2 ON innova_activity (activity_sequence_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE innova_activity_type_available_activity
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_available
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD COLUMN class VARCHAR(255) NOT NULL
        ");
    }
}