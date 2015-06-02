<?php

namespace Innova\ActivityBundle\Migrations\ibm_db2;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/05/22 01:14:09
 */
class Version20150522131407 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            ADD COLUMN date_created TIMESTAMP(0) NOT NULL WITH DEFAULT
        ");
        $this->addSql("
            ALTER TABLE innova_activity_sequence 
            ADD COLUMN numTries INTEGER NOT NULL WITH DEFAULT
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            DROP COLUMN date_created
        ");
        $this->addSql("
            CALL SYSPROC.ADMIN_CMD (
                'REORG TABLE innova_activity_answer'
            )
        ");
        $this->addSql("
            ALTER TABLE innova_activity_sequence 
            DROP COLUMN numTries
        ");
        $this->addSql("
            CALL SYSPROC.ADMIN_CMD (
                'REORG TABLE innova_activity_sequence'
            )
        ");
    }
}