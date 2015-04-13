<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/04/08 11:37:30
 */
class Version20150408113729 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD COLUMN name VARCHAR(255) NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX IDX_4605013FC54C8C93
        ");
        $this->addSql("
            DROP INDEX IDX_4605013FA49B0ADA
        ");
        $this->addSql("
            DROP INDEX IDX_4605013F967573A2
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity AS 
            SELECT id, 
            type_id, 
            media_type_id, 
            activity_sequence_id, 
            description, 
            question, 
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
                type_id INTEGER DEFAULT NULL, 
                media_type_id INTEGER DEFAULT NULL, 
                activity_sequence_id INTEGER DEFAULT NULL, 
                description CLOB DEFAULT NULL, 
                question CLOB DEFAULT NULL, 
                activity_position INTEGER NOT NULL, 
                date_created DATETIME NOT NULL, 
                date_updated DATETIME NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_4605013FC54C8C93 FOREIGN KEY (type_id) 
                REFERENCES innova_activity_available_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_4605013FA49B0ADA FOREIGN KEY (media_type_id) 
                REFERENCES innova_activity_prop_media_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_4605013F967573A2 FOREIGN KEY (activity_sequence_id) 
                REFERENCES innova_activity_sequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity (
                id, type_id, media_type_id, activity_sequence_id, 
                description, question, activity_position, 
                date_created, date_updated
            ) 
            SELECT id, 
            type_id, 
            media_type_id, 
            activity_sequence_id, 
            description, 
            question, 
            activity_position, 
            date_created, 
            date_updated 
            FROM __temp__innova_activity
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013FC54C8C93 ON innova_activity (type_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013FA49B0ADA ON innova_activity (media_type_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013F967573A2 ON innova_activity (activity_sequence_id)
        ");
    }
}