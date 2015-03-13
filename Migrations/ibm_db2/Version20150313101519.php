<?php

namespace Innova\ActivityBundle\Migrations\ibm_db2;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/13 10:15:21
 */
class Version20150313101519 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple 
            ADD COLUMN randomlyOrdered SMALLINT NOT NULL WITH DEFAULT
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            ADD COLUMN randomlyOrdered SMALLINT NOT NULL WITH DEFAULT
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            ADD COLUMN randomlyOrdered SMALLINT NOT NULL WITH DEFAULT
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            DROP COLUMN randomlyOrdered
        ");
        $this->addSql("
            CALL SYSPROC.ADMIN_CMD (
                'REORG TABLE innova_activity_prop_choice'
            )
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            ADD COLUMN randomlyOrdered SMALLINT NOT NULL WITH DEFAULT
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            DROP COLUMN randomlyOrdered
        ");
        $this->addSql("
            CALL SYSPROC.ADMIN_CMD (
                'REORG TABLE innova_activity_type_boolean'
            )
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple 
            DROP COLUMN randomlyOrdered
        ");
        $this->addSql("
            CALL SYSPROC.ADMIN_CMD (
                'REORG TABLE innova_activity_type_multiple'
            )
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            DROP COLUMN randomlyOrdered
        ");
        $this->addSql("
            CALL SYSPROC.ADMIN_CMD (
                'REORG TABLE innova_activity_type_unique'
            )
        ");
    }
}