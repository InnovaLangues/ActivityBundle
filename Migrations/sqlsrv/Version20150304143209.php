<?php

namespace Innova\ActivityBundle\Migrations\sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/04 02:32:11
 */
class Version20150304143209 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            DROP CONSTRAINT FK_C0062329B87FAB32
        ");
        $this->addSql("
            IF EXISTS (
                SELECT * 
                FROM sysobjects 
                WHERE name = 'UNIQ_C0062329B87FAB32'
            ) 
            ALTER TABLE innova_activity_answer 
            DROP CONSTRAINT UNIQ_C0062329B87FAB32 ELSE 
            DROP INDEX UNIQ_C0062329B87FAB32 ON innova_activity_answer
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            DROP COLUMN resourceNode_id
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            ADD resourceNode_id INT
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            ADD CONSTRAINT FK_C0062329B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_C0062329B87FAB32 ON innova_activity_answer (resourceNode_id) 
            WHERE resourceNode_id IS NOT NULL
        ");
    }
}