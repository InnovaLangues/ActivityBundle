<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/13 09:50:02
 */
class Version20150313094954 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            ADD COLUMN randomlyOrdered BOOLEAN NOT NULL
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
                correct_answer BOOLEAN NOT NULL, 
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