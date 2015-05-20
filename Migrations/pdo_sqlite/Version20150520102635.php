<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/05/20 10:26:36
 */
class Version20150520102635 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_sequence 
            ADD COLUMN numTries INTEGER NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX UNIQ_CA5D5B00B87FAB32
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_sequence AS 
            SELECT id, 
            description, 
            resourceNode_id 
            FROM innova_activity_sequence
        ");
        $this->addSql("
            DROP TABLE innova_activity_sequence
        ");
        $this->addSql("
            CREATE TABLE innova_activity_sequence (
                id INTEGER NOT NULL, 
                description CLOB DEFAULT NULL, 
                resourceNode_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_CA5D5B00B87FAB32 FOREIGN KEY (resourceNode_id) 
                REFERENCES claro_resource_node (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_sequence (id, description, resourceNode_id) 
            SELECT id, 
            description, 
            resourceNode_id 
            FROM __temp__innova_activity_sequence
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_sequence
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_CA5D5B00B87FAB32 ON innova_activity_sequence (resourceNode_id)
        ");
    }
}