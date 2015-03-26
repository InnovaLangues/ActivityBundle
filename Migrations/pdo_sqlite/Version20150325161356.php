<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/25 04:13:58
 */
class Version20150325161356 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_media_type 
            ADD COLUMN template CLOB NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_prop_media_type AS 
            SELECT id, 
            name, 
            description, 
            title 
            FROM innova_activity_prop_media_type
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_media_type
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_media_type (
                id INTEGER NOT NULL, 
                name CLOB NOT NULL, 
                description CLOB NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_prop_media_type (id, name, description, title) 
            SELECT id, 
            name, 
            description, 
            title 
            FROM __temp__innova_activity_prop_media_type
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_prop_media_type
        ");
    }
}