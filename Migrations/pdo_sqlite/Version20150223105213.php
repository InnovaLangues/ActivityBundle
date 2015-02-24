<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/02/23 10:52:13
 */
class Version20150223105213 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD COLUMN description CLOB DEFAULT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX IDX_4605013FC54C8C93
        ");
        $this->addSql("
            DROP INDEX UNIQ_4605013FB87FAB32
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity AS 
            SELECT id, 
            type_id, 
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
            INSERT INTO innova_activity (id, type_id, resourceNode_id) 
            SELECT id, 
            type_id, 
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
    }
}