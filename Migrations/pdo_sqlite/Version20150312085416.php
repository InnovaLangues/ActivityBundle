<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/12 08:54:24
 */
class Version20150312085416 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_instruction 
            ADD COLUMN position INTEGER NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_content 
            ADD COLUMN position INTEGER NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX IDX_C535F34581C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_prop_content AS 
            SELECT id, 
            activity_id, 
            media, 
            title 
            FROM innova_activity_prop_content
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_content
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_content (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                media CLOB NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_C535F34581C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_prop_content (id, activity_id, media, title) 
            SELECT id, 
            activity_id, 
            media, 
            title 
            FROM __temp__innova_activity_prop_content
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_prop_content
        ");
        $this->addSql("
            CREATE INDEX IDX_C535F34581C06096 ON innova_activity_prop_content (activity_id)
        ");
        $this->addSql("
            DROP INDEX IDX_D14D3F5681C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_prop_instruction AS 
            SELECT id, 
            activity_id, 
            media, 
            title 
            FROM innova_activity_prop_instruction
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_instruction
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_instruction (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                media CLOB NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_D14D3F5681C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_prop_instruction (id, activity_id, media, title) 
            SELECT id, 
            activity_id, 
            media, 
            title 
            FROM __temp__innova_activity_prop_instruction
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_prop_instruction
        ");
        $this->addSql("
            CREATE INDEX IDX_D14D3F5681C06096 ON innova_activity_prop_instruction (activity_id)
        ");
    }
}