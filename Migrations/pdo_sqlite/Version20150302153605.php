<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/02 03:36:06
 */
class Version20150302153605 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            ADD COLUMN correct_answer BOOLEAN NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_prop_choice AS 
            SELECT id, 
            media, 
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
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_prop_choice (id, media, title) 
            SELECT id, 
            media, 
            title 
            FROM __temp__innova_activity_prop_choice
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_prop_choice
        ");
    }
}