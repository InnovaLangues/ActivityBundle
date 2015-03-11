<?php

namespace Innova\ActivityBundle\Migrations\ibm_db2;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/11 01:45:48
 */
class Version20150311134543 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD COLUMN question CLOB(1M) NOT NULL WITH DEFAULT
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP COLUMN question
        ");
        $this->addSql("
            CALL SYSPROC.ADMIN_CMD ('REORG TABLE innova_activity')
        ");
    }
}