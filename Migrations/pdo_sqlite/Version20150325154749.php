<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/25 03:47:55
 */
class Version20150325154749 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            DROP INDEX UNIQ_4605013FB87FAB32
        ");
        $this->addSql("
            DROP INDEX IDX_4605013FC54C8C93
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity AS 
            SELECT id, 
            type_id, 
            description, 
            resourceNode_id, 
            question 
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
                description CLOB DEFAULT NULL COLLATE utf8_unicode_ci, 
                resourceNode_id INTEGER DEFAULT NULL, 
                question CLOB DEFAULT NULL COLLATE utf8_unicode_ci, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_4605013FB87FAB32 FOREIGN KEY (resourceNode_id) 
                REFERENCES claro_resource_node (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_4605013FC54C8C93 FOREIGN KEY (type_id) 
                REFERENCES innova_activity_available_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_4605013FA49B0ADA FOREIGN KEY (media_type_id) 
                REFERENCES innova_activity_prop_media_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity (
                id, type_id, description, resourceNode_id, 
                question
            ) 
            SELECT id, 
            type_id, 
            description, 
            resourceNode_id, 
            question 
            FROM __temp__innova_activity
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_4605013FB87FAB32 ON innova_activity (resourceNode_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013FC54C8C93 ON innova_activity (type_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013FA49B0ADA ON innova_activity (media_type_id)
        ");
        $this->addSql("
            DROP INDEX IDX_5F487EB2A49B0ADA
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_prop_choice AS 
            SELECT id, 
            media, 
            title, 
            correct_answer, 
            position 
            FROM innova_activity_prop_choice
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_choice
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_choice (
                id INTEGER NOT NULL, 
                media CLOB NOT NULL COLLATE utf8_unicode_ci, 
                title VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, 
                correct_answer BOOLEAN NOT NULL, 
                position INTEGER NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_prop_choice (
                id, media, title, correct_answer, position
            ) 
            SELECT id, 
            media, 
            title, 
            correct_answer, 
            position 
            FROM __temp__innova_activity_prop_choice
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_prop_choice
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
            DROP INDEX UNIQ_4605013FB87FAB32
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity AS 
            SELECT id, 
            type_id, 
            description, 
            question, 
            resourceNode_id 
            FROM innova_activity
        ");
        $this->addSql("
            DROP TABLE innova_activity
        ");
        $this->addSql("
            CREATE TABLE innova_activity (
                id INTEGER NOT NULL, 
                type_id INTEGER DEFAULT NULL, 
                description CLOB DEFAULT NULL, 
                question CLOB DEFAULT NULL, 
                resourceNode_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_4605013FC54C8C93 FOREIGN KEY (type_id) 
                REFERENCES innova_activity_available_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_4605013FB87FAB32 FOREIGN KEY (resourceNode_id) 
                REFERENCES claro_resource_node (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity (
                id, type_id, description, question, 
                resourceNode_id
            ) 
            SELECT id, 
            type_id, 
            description, 
            question, 
            resourceNode_id 
            FROM __temp__innova_activity
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013FC54C8C93 ON innova_activity (type_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_4605013FB87FAB32 ON innova_activity (resourceNode_id)
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
                media_type_id INTEGER DEFAULT NULL, 
                media CLOB NOT NULL, 
                correct_answer BOOLEAN NOT NULL, 
                position INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_5F487EB2A49B0ADA FOREIGN KEY (media_type_id) 
                REFERENCES innova_activity_prop_media_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE
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
            CREATE INDEX IDX_5F487EB2A49B0ADA ON innova_activity_prop_choice (media_type_id)
        ");
    }
}