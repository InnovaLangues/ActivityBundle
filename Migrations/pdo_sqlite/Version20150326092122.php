<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/26 09:21:27
 */
class Version20150326092122 extends AbstractMigration
{
    public function up(Schema $schema)
    {
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
                position INTEGER NOT NULL, 
                correct_answer CLOB NOT NULL, 
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
                position INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                correct_answer BOOLEAN NOT NULL, 
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