<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/05/26 09:29:16
 */
class Version20150526092913 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_prop_choice AS 
            SELECT id, 
            media, 
            correct_answer, 
            position, 
            title 
            FROM innova_activity_prop_choice
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_choice
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_choice (
                id INTEGER NOT NULL, 
                resource_id INTEGER DEFAULT NULL, 
                media CLOB NOT NULL COLLATE utf8_unicode_ci, 
                correct_answer CLOB NOT NULL COLLATE utf8_unicode_ci, 
                position INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_5F487EB289329D25 FOREIGN KEY (resource_id) 
                REFERENCES claro_resource_node (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_prop_choice (
                id, media, correct_answer, position, 
                title
            ) 
            SELECT id, 
            media, 
            correct_answer, 
            position, 
            title 
            FROM __temp__innova_activity_prop_choice
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_prop_choice
        ");
        $this->addSql("
            CREATE INDEX IDX_5F487EB289329D25 ON innova_activity_prop_choice (resource_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX IDX_5F487EB289329D25
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_prop_choice AS 
            SELECT id, 
            media, 
            correct_answer, 
            position, 
            title 
            FROM innova_activity_prop_choice
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_choice
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_choice (
                id INTEGER NOT NULL, 
                media CLOB NOT NULL, 
                correct_answer CLOB NOT NULL, 
                position INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_prop_choice (
                id, media, correct_answer, position, 
                title
            ) 
            SELECT id, 
            media, 
            correct_answer, 
            position, 
            title 
            FROM __temp__innova_activity_prop_choice
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_prop_choice
        ");
    }
}