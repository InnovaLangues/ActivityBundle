<?php

namespace Innova\ActivityBundle\Migrations\ibm_db2;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/24 10:33:14
 */
class Version20150324103312 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_media_type 
            ADD COLUMN title VARCHAR(255) DEFAULT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_media_type 
            DROP COLUMN title
        ");
        $this->addSql("
            CALL SYSPROC.ADMIN_CMD (
                'REORG TABLE innova_activity_prop_media_type'
            )
        ");
    }
}