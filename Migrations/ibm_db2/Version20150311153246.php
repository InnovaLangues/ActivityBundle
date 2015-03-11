<?php

namespace Innova\ActivityBundle\Migrations\ibm_db2;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/11 03:32:47
 */
class Version20150311153246 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity ALTER COLUMN question 
            DROP NOT NULL
        ");
        $this->addSql("
            CALL SYSPROC.ADMIN_CMD ('REORG TABLE innova_activity')
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity ALTER COLUMN question 
            SET 
                NOT NULL
        ");
        $this->addSql("
            CALL SYSPROC.ADMIN_CMD ('REORG TABLE innova_activity')
        ");
    }
}