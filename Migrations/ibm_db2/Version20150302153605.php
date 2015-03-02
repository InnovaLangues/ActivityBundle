<?php

namespace Innova\ActivityBundle\Migrations\ibm_db2;

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
            ADD COLUMN correct_answer SMALLINT NOT NULL WITH DEFAULT
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            DROP COLUMN correct_answer
        ");
        $this->addSql("
            CALL SYSPROC.ADMIN_CMD (
                'REORG TABLE innova_activity_prop_choice'
            )
        ");
    }
}